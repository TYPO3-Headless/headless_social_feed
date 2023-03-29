<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Controller;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use FriendsOfTYPO3\HeadlessSocialFeed\Domain\Repository\ConfigurationRepository;
use RuntimeException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class CallbackController extends ActionController
{
    /**
     * @var ConfigurationRepository
     */
    protected ConfigurationRepository $configurationRepository;

    /**
     * @var PersistenceManager
     */
    protected PersistenceManager $persistenceManager;

    public function __construct()
    {
        $this->configurationRepository = GeneralUtility::makeInstance(ConfigurationRepository::class);
        $this->persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
    }

    public function retrieveAction(): void
    {
        session_start();

        $configuration = $this->configurationRepository->getConfiguration();

        if (isset($_GET['state'])) {
            $_SESSION['FBRLH_state'] = $_GET['state'];
        }

        if ($configuration && $configuration->getAppId() && $configuration->getAppSecret()) {
            try {
                $fb = new Facebook([
                    'app_id' => $configuration->getAppId(),
                    'app_secret' => $configuration->getAppSecret(),
                    'default_graph_version' => 'v12.0',
                ]);

                $helper = $fb->getRedirectLoginHelper();
                $accessToken = $helper->getAccessToken();

                if (!isset($accessToken)) {
                    if ($helper->getError()) {
                        throw new RuntimeException($helper->getError());
                    }
                    throw new RuntimeException("Bad request");
                }

                $oAuth2Client = $fb->getOAuth2Client();
                $tokenMetadata = $oAuth2Client->debugToken($accessToken);
                $tokenMetadata->validateAppId($configuration->getAppId());

                if (!$accessToken->isLongLived()) {
                    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
                }

                $configuration->setAccessToken((string)$accessToken);
                $this->configurationRepository->update($configuration);
                $this->persistenceManager->persistAll();

            } catch(FacebookResponseException|FacebookSDKException|IllegalObjectTypeException|UnknownObjectException $e) {
                echo 'Error: ' . $e->getMessage();
                exit;
            }

            echo 'Access Token generated and stored successfully!';
            exit;
        }
    }
}

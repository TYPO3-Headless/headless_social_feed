<?php
declare(strict_types=1);

namespace FriendsOfTYPO3\HeadlessSocialFeed\Command;

use FriendsOfTYPO3\HeadlessSocialFeed\Controller\SettingsController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ImportFeedsCommand extends Command
{
    /**
     * @throws Exception
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $settingsController = GeneralUtility::makeInstance(SettingsController::class);
        $result = $settingsController->importFeeds();
        if ($result !== []) {
            throw new Exception($result['message']);
        }
        return Command::SUCCESS;
    }
}
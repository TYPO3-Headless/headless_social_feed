<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Authorization;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class FacebookAuth
{
    private $app_id;
    private $app_secret;
    private $redirect_url;
    private $access_token;

    public function __construct($app_id, $app_secret, $redirect_url) {
        $this->app_id = $app_id;
        $this->app_secret =$app_secret;
        $this->redirect_url = $redirect_url;
    }

    public function getLoginUrl($scope = ['email']){
        $fb = new Facebook([
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => 'v12.0',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        return $helper->getLoginUrl($this->redirect_url, $scope);
    }

    public function getAccessToken() {
        $fb = new Facebook([
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => 'v12.0',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $access_token = $helper->getAccessToken();
            $this->access_token = $access_token->getValue();
            return $this->access_token;
        } catch (FacebookResponseException $e) {
            return 'Graph returned an error: ' . $e->getMessage();
        } catch (FacebookSDKException $e) {
            return 'Facebook SDK returned an error: ' . $e->getMessage();
        }
    }
}
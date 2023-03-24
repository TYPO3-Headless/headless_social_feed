<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Command;

use Facebook\Facebook;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AuthorizationCommand extends Command
{
    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        session_start();

        $fb = new Facebook([
            'app_id' => '523898953251586',
            'app_secret' => 'fd0a29d76ed92bbc52d89256c763f7d3',
            'default_graph_version' => 'v2.10'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $url = $helper->getLoginUrl('https://headless-social-feed.ddev.site/login-callback');

        $accessToken = $helper->getAccessToken();

        return Command::SUCCESS;
    }
}
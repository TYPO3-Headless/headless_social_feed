<?php

namespace FriendsOfTYPO3\HeadlessSocialFeed\Evaluation;

class FeedMessageEvaluation
{
    public function deevaluateFieldValue(array $parameters)
    {
        return base64_decode($parameters['value']);
    }
}

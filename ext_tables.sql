#
# Table structure for table 'tx_headlesssocialfeed_domain_model_configuration'
#
CREATE TABLE tx_headlesssocialfeed_domain_model_configuration
(
    uid                 int(11)                         NOT NULL auto_increment,
    pid                 int(11)             DEFAULT '0' NOT NULL,

    name                varchar(255)        DEFAULT ''  NOT NULL,
    app_id              varchar(255)        DEFAULT ''  NOT NULL,
    app_secret          varchar(255)        DEFAULT ''  NOT NULL,
    access_token        varchar(255)        DEFAULT ''  NOT NULL,
    max_items           int(11)             DEFAULT '0' NOT NULL,
    storage             int(11)             DEFAULT '0' NOT NULL,
    page_name           varchar(255)        DEFAULT ''  NOT NULL,
    page_id             varchar(255)        DEFAULT ''  NOT NULL,
    page_access_token   varchar(255)        DEFAULT ''  NOT NULL,
    callback_url        varchar(255)        DEFAULT ''  NOT NULL,
    feeds_title         varchar(255)        DEFAULT ''  NOT NULL,

    tstamp              int(11) unsigned    DEFAULT '0' NOT NULL,
    crdate              int(11) unsigned    DEFAULT '0' NOT NULL,
    cruser_id           int(11) unsigned    DEFAULT '0' NOT NULL,
    deleted             tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden              tinyint(4) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

#
# Table structure for table 'tx_headlesssocialfeed_domain_model_feed'
#
CREATE TABLE tx_headlesssocialfeed_domain_model_feed
(
    uid             int(11)                         NOT NULL auto_increment,
    pid             int(11)             DEFAULT '0' NOT NULL,

    external_uid    varchar(255)        DEFAULT ''  NOT NULL,
    date_time       int(11)             DEFAULT '0' NOT NULL,
    message         text                DEFAULT ''  NOT NULL,
    image           text                DEFAULT ''  NOT NULL,
    likes           int(11)             DEFAULT '0' NOT NULL,
    comments        int(11)             DEFAULT '0' NOT NULL,
    url             varchar(255)        DEFAULT ''  NOT NULL,
    title           varchar(255)        DEFAULT ''  NOT NULL,

    tstamp          int(11) unsigned    DEFAULT '0' NOT NULL,
    crdate          int(11) unsigned    DEFAULT '0' NOT NULL,
    cruser_id       int(11) unsigned    DEFAULT '0' NOT NULL,
    deleted         tinyint(4) unsigned DEFAULT '0' NOT NULL,
    hidden          tinyint(4) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid)
);

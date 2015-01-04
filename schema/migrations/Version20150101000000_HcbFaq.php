<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20150101000000_HcbFaq extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE TABLE `faq` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `created_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");

        $this->addSql("CREATE TABLE `faq_localized` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locale_id` int(10) unsigned NOT NULL,
  `faq_id` int(10) unsigned NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faq_localized_faq1_idx` (`faq_id`),
  KEY `fk_faq_localized_locale1_idx` (`locale_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;");

            $this->addSql("ALTER TABLE `faq_localized`
  ADD CONSTRAINT `fk_faq_localized_faq1` FOREIGN KEY (`faq_id`) REFERENCES `faq` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_faq_localized_locale1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");
    }

    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE faq_localized;");
        $this->addSql("DROP TABLE faq;");
    }
}

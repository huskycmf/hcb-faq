<?php
namespace HcbFaq\Data;

use HcCore\Data\LocaleInterface;

interface LocalizedInterface extends LocaleInterface
{
    /**
     * @return string
     */
    public function getQuestion();

    /**
     * @return string
     */
    public function getAnswer();
}

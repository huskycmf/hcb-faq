<?php
namespace HcbFaq\Data;

use HcCore\Data\DataMessagesInterface;
use HcCore\Stdlib\Extractor\Request\Payload\Extractor;
use Zend\Di\Di;
use Zend\Http\PhpEnvironment\Request;
use HcCore\InputFilter\InputFilter;


class Localized extends InputFilter implements LocalizedInterface, DataMessagesInterface
{
    /**
     * @param Request $request
     * @param Extractor $dataExtractor
     * @param Di $di
     */
    public function __construct(Request $request,
                                Extractor $dataExtractor,
                                Di $di) {
        /* @var $input \HcBackend\InputFilter\Input\Locale */
        $input = $di->get( 'HcBackend\InputFilter\Input\Locale',
            array( 'name' => 'lang' ) )
                    ->setRequired( true );
        $this->add( $input );

        $this->add( array(
            'name'       => 'question',
            'required'   => true,
            'allowEmpty' => false,
            'filters'    => array( array( 'name' => 'StringTrim' ) )
        ) );

        $this->add( array(
            'name'       => 'answer',
            'required'   => true,
            'allowEmpty' => false,
            'filters'    => array( array( 'name' => 'StringTrim' ) )
        ) );

        $this->setData( $dataExtractor->extract( $request ) );
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getValue('lang');
    }


    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->getValue('question');
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->getValue('answer');
    }
}

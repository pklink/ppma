<?php

class EModal extends CWidget
{

    /**
     * @var string
     */
    public static $buffer = '';

    /**
     * @var string
     */
    public $type = 'medium';

    /**
     * @var bool
     */
    public $outputBuffer = false;

    /**
     * @var string
     */
    public $id = 'modal';

    /**
     * @return void
     */
    public function init()
    {
        parent::init();

        // start buffering
        ob_start();
    }

    /**
     * @return void
     */
    public function run()
    {
        parent::run();

        // save & clean buffer
        $content = ob_get_contents();
        ob_end_clean();

        if ($this->outputBuffer) {
            echo EModal::$buffer;
        } else {
            EModal::$buffer .= $this->render('modal', array('id' => $this->id, 'content' => $content), true);
        }
    }
}

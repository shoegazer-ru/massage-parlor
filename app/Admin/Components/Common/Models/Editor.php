<?php

namespace App\Admin\Components\Common\Models;

use App\Admin\Components\Common\Models\Form;

/**
 * [Description Model]
 */
class Editor
{
    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $note;

    /**
     * @var array
     */
    public array $messages;

    /**
     * @var Form
     */
    public Form $form;

    public function __construct(
        string $title,
        ?string $note,
        ?array $messages = []
    ) {
        $this->title = $title;
        $this->note = $note;
        $this->messages = $messages;
    }

    /**
     * @param Form $form
     * 
     * @return void
     */
    public function setForm(Form $form): void
    {
        $this->form = $form;
    }
}

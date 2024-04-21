<?php

namespace App\Response;

use Illuminate\Http\Response;

class AbstractResponse extends Response
{
    public function setContent(mixed $content): static
    {
        $content = $this->addToContent($content, []);

        return parent::setContent($content);
    }

    /**
     * @param mixed $content
     * @param mixed $additionalData
     * @return mixed
     * @todo
     */
    protected function addToContent(mixed $content, mixed $additionalData): mixed
    {
        return $content;
    }
}
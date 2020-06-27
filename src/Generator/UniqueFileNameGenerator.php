<?php


namespace App\Generator;


class UniqueFileNameGenerator
{
    private $method;

    private $prefix;

    private $label;

    public function __construct(?string $method, ?string $prefix, ?string $label)
    {
        $this->method = $method ?? 'default';
        $this->prefix = $prefix ?? null;
        $this->label = $label ?? null;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string|null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param string|null $prefix
     */
    public function setPrefix(?string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function generate(?string $label)
    {
        //dd($this);
        switch ($this->getMethod()) {
            case 'label':
                if (null !== $label) {
                    return $label;
                }
                break;
            default:
                return uniqid('FILE_', true);
        }
    }
}

<?php

/**
 * User: ArmiT <armit@twinscom.ru>
 */

namespace transactions\tests\utils;

class LabRat
{
    protected $path;

    public function __construct($path)
    {
        $this->path = dirname(__DIR__).'/temp/'.$path;

        \touch($this->path);

        $this->checkHealth();
    }

    protected function checkHealth()
    {
        if (!file_exists($this->path)) {
            throw new \ErrorException(
                sprintf('Rat [%s] is dead', $this->path)
            );
        }
    }

    public function inject($agent)
    {
        $dump = $this->inspect();
        $dump[] = $agent;
        $this->fill($dump);
    }

    public function ectomy($agent)
    {
        $dump = $this->inspect();
        $dump = \array_diff($dump, [$agent]);
        $this->fill($dump);
    }

    protected function fill($content)
    {
        $this->checkHealth();

        return \file_put_contents(
            $this->path,
            \json_encode($content)
        );
    }

    public function inspect()
    {
        $this->checkHealth();

        return \json_decode(
            \file_get_contents($this->path) ?: '{}',
            true
        );
    }

    public function clearAnamnesis()
    {
        $this->checkHealth();
        $this->fill([]);
    }
}

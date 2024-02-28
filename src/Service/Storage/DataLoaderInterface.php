<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\Storage;

interface DataLoaderInterface
{
    public function getDataStructure(): DataStorageInterface;
}

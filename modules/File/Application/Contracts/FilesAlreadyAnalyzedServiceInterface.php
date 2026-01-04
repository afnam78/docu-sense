<?php

namespace Modules\File\Application\Contracts;

use Exception;

interface FilesAlreadyAnalyzedServiceInterface
{
    /**
     * Processes an array of documents by iterating through each file and performing operations
     * based on the existence of associated entities in the repository. For entities not found in
     * the repository, it adds an alias with the file's original name and tenant's identifier.
     *
     * @param  array  $documents  An array of documents to be processed, where each document
     *                            includes a hash and the associated uploaded file details.
     *
     * @throws Exception If an error occurs during processing.
     */
    public function execute(array $documents): void;
}

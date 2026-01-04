<?php

namespace Modules\File\Application\Contracts;

use Exception;

interface FilesToAnalyzeServiceInterface
{
    /**
     * Processes an array of uploaded documents and dispatches a batch of jobs
     * to handle the files based on their mime types.
     *
     * This method iterates through the provided documents, validates the mime type
     * of each file, and prepares handling jobs accordingly. It specifically supports
     * image files (JPEG, PNG, JPG) and PDF files. The jobs are batched and dispatched
     * for processing.
     *
     * @param  array  $documents  The array of uploaded documents to process.
     *
     * @throws Exception If an error occurs during job dispatching.
     */
    public function execute(array $documents): void;
}

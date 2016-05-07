<?php

/**
 * @return \Illuminate\Support\Collection
 */
function getArticles()
{
    return collect(
        glob('source/blog/*.md')
    )->map(function ($file) {
        $contents = file_get_contents($file);

        // Extract frontmatter
        $contents = substr($contents, 3);
        $contents = substr($contents, 0, strpos($contents, '---'));

        $lines = explode("\n", trim($contents));

        $articleInfo = [
            'filename' => basename($file, '.md')
        ];

        foreach ($lines as $line) {
            list($key, $value) = explode(': ', $line, 2);
            $articleInfo[$key] = trim($value, '"');
        }

        return $articleInfo;
    });
}

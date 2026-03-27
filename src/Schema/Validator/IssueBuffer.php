<?php declare(strict_types=1);

namespace Swiftly\Config\Schema\Validator;

use Swiftly\Config\Schema\Validator\Issue\NodeIssue;

final class IssueBuffer
{
    /**
     * @var array<non-empty-string, NodeIssue> 
     */
    public array $issues = [];

    /**
     * @param non-empty-string $path
     */
    public function pushIssue(string $path, NodeIssue $issue): void
    {
        if (!isset($this->issues[$path])) {
            $this->issues[$path] = [];
        }

        $this->issues[$path][] = $issue;
    }

    public function hasIssues(): bool
    {
        return !empty($this->issues);
    }

    public function getIssues(): array
    {
        return $this->issues;
    }
}

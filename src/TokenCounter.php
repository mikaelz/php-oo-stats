<?php

namespace OoStats;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class TokenCounter extends NodeVisitorAbstract
{
    private string $statsFilePath = STATS_JSON_PATH;

    private array $stats = [];

    public function beforeTraverse(array $nodes): void
    {
        if (is_file($this->statsFilePath)) {
            $this->stats = json_decode(file_get_contents($this->statsFilePath), true);
        }
    }

    public function leaveNode(Node $node): void
    {
        if ($node instanceof Node\Stmt\UseUse) {
            $category = $node->getAlias()->name;
            $this->count('use', $category);
        }
        if ($node instanceof Node\Stmt\Namespace_) {
            $category = implode('_', $node->name->parts);
            $this->count('namespace', $category);
        }
        if ($node instanceof Node\Stmt\Class_ && ! empty($node->namespacedName->parts)) {
            $category = implode('_', $node->namespacedName->parts);
            $this->count('class', $category);
        }
    }

    public function afterTraverse(array $nodes): void
    {
        file_put_contents($this->statsFilePath, json_encode($this->stats));
    }

    private function count(string $category, string $name): void
    {
        if (isset($this->stats[$category][$name])) {
            ++$this->stats[$category][$name];
        } else {
            $this->stats[$category][$name] = 1;
        }
    }
}

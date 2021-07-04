<?php

declare(strict_types=1);

namespace Isfar;

use InvalidArgumentException;
use PDO;


class Document
{
    public function __construct(
        private string $name,
        private User $user,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}

class DocumentFactory
{
    public function create(string $name, User $user): Document
    {
        if (strlen($name) > 5) {
            throw new InvalidArgumentException('Name should at least 5 characters long.');
        }

        if (!strpos(strtolower($name), 'senior')) {
            throw new InvalidArgumentException('The name should contain "senior".');
        }

        return new Document($name, $user);
    }
}

class DocumentRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function getDocumentTitleByName(string $name): string
    {
        $row = $this->pdo->query('SELECT * FROM document WHERE name = "' . $name . '" LIMIT 1');

        return $row[3]; // third column in a row
    }

    /**
     * @return Document[]
     */
    public function getAllDocuments(): array
    {
        // use pdo query and document hydrators
        return [];
    }

    /**
     * @param User $user
     * 
     * @return Document[]
     */
    public function getDocumentsByUser(User $user): array
    {
        // use pdo query and document hydrators
        return [];
    }
}

class User
{
    // properties
    // methods
}

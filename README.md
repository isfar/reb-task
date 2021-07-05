---
title: Rebilly
tags: []
---

# Assignment

## Setup Enviroment

```bash
git checkout https://github.com/isfar/reb-task.git
cd reb-task
docker-compose up -d  
docker-compose exec php composer install
```

## Answers

### Answer 1

We don't have an index for the column `email`. So, the search complexity is `O(n)`. Meaning, the emails are not sorted, if there are 1 million records, in the worst case, mysql will have to go through each of 1 million records. If we sort them out with an **index**, the search complexity would be `O(logn)`, which is like, only 20 iterations for 1 million records. 

```sql
ALTER TABLE `users` ADD INDEX `idx_users_email` (`email`)
```

### Answer 2

If we use `in_array` function, it will traverse through the whole array. The complexity is linear, i.e., `O(n)`. As it is sorted, we could use binary search, that's `O(logn)`. Even better approch would be using a hashmap, that is associative arrays to check if the key exists. This way, the complexity is a constant time `O(n)`. This is actually a set operation, so I wrote the set class `src/Set.php` and it's test `tests/SetTest.php`.


### Answer 3 

Increasing `memory_limit` might solve this, but that's not a smart solution. That will eat-up the memory and may result in denial of service. We should fetch all the records with pagination. The `$per_page` should be tuned according to usecase, available memory and the total number of records. The downside of this approach is the waiting time for the blocking operation. We can overcome this by using non-blocking event-loop libraries like `react-php`. (The following code isn't tested, it's meant to give the overall idea)

```php
$per_page = 1000;

/** @var PDO $pdo */
$stmt = $pdo->query('SELECT COUNT(*) FROM largeTable');
$total_results = $stmt->fetchColumn();

$total_pages = ceil($total_results / $per_page);

$stmt = $pdo->prepare('SELECT * FROM largeTable ORDER BY id DESC LIMIT ? OFFSET ?');

foreach (range(1, $total_pages) as $current_page) {
    $offset = ($current_page - 1) * $per_page; 

    $stmt->execute([$per_page, $offset]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result) {
        // manipulate the data here
    }
}
```

### Answer 4

Code: `src/PhoneNumberFormatter.php`
Test: `tests/PhoneNumberFormatterTest.php`

### Answer 5

`PSR-6` has nice caching abstractions. But for simplicity's sake, I implemented simple adapter pattern for this. We have the simple abstraction for the cache adapters-- `src/Cache/AdapterInterface.php`. For production we will use `src/Cache/Adapter/MemcachedAdapter.php`. `MemcachedAdapter` has `Factory` to simplify its creation. Then we have `src/Cache/Adapter/ApcAdapter.php` for staging and `src/Cache/Adapter/NullAdapter.php` which actually does nothing.

### Answer 6

The test cases for `FizBuzz` is written in the file `tests/FizBuzzTest.php`

### Answer 7 

We need to implement `__toString()` magic method in the `SELECT` class.

### Answer 8

Here, `Document` and `User` are actually *entities*. So, they shouldn't concern themselves with database logic. So I moved `Document::getTitle` to `DocumentRepository::getDocumentTitleByName`, `Document::getAllDocuments` to `DocumentRepository::getAllDocuments` and `User::getMyDocuments` to `DocumentRepository::getDocumentsByUser`. Also, instead of `User::makeNewDocument` and `Document::init`, we are now using `Document::__construct` and `DocumentFactory::create` methods.

```php
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
```

## Static Code Analyzer

All the codes are analyzed with `phpstan`. To run the static analyzer--

```bash
 docker-compose exec php vendor/bin/phpstan analyze --level=6 src tests
```

## Running Unit Tests

I didn't define any phpunit suite as we don't have many test files. To run the test files-- 


```bash
docker-compose exec php vendor/bin/phpunit tests
```

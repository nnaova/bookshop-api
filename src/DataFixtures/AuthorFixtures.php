<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public const AUTHOR_1_REFERENCE = 'author-jk-rowling';
    public const AUTHOR_2_REFERENCE = 'author-tolkien';
    public const AUTHOR_3_REFERENCE = 'author-asimov';
    public const AUTHOR_4_REFERENCE = 'author-christie';
    public const AUTHOR_5_REFERENCE = 'author-orwell';
    public const AUTHOR_6_REFERENCE = 'author-austen';
    public const AUTHOR_7_REFERENCE = 'author-hemingway';
    public const AUTHOR_8_REFERENCE = 'author-bradbury';

    public function load(ObjectManager $manager): void
    {
        // J.K. Rowling
        $author1 = new Author();
        $author1->setName('J.K. Rowling')
            ->setBiography('British author best known for the Harry Potter fantasy series. The books have won multiple awards and sold more than 500 million copies.')
            ->setBirthDate(new \DateTimeImmutable('1965-07-31'));
        $manager->persist($author1);
        $this->addReference(self::AUTHOR_1_REFERENCE, $author1);

        // J.R.R. Tolkien
        $author2 = new Author();
        $author2->setName('J.R.R. Tolkien')
            ->setBiography('English writer, poet, philologist, and academic, best known as the author of The Hobbit and The Lord of the Rings.')
            ->setBirthDate(new \DateTimeImmutable('1892-01-03'));
        $manager->persist($author2);
        $this->addReference(self::AUTHOR_2_REFERENCE, $author2);

        // Isaac Asimov
        $author3 = new Author();
        $author3->setName('Isaac Asimov')
            ->setBiography('American writer and professor of biochemistry, prolific author of science fiction and popular science books.')
            ->setBirthDate(new \DateTimeImmutable('1920-01-02'));
        $manager->persist($author3);
        $this->addReference(self::AUTHOR_3_REFERENCE, $author3);

        // Agatha Christie
        $author4 = new Author();
        $author4->setName('Agatha Christie')
            ->setBiography('English writer known for her 66 detective novels and 14 short story collections, particularly featuring Hercule Poirot and Miss Marple.')
            ->setBirthDate(new \DateTimeImmutable('1890-09-15'));
        $manager->persist($author4);
        $this->addReference(self::AUTHOR_4_REFERENCE, $author4);

        // George Orwell
        $author5 = new Author();
        $author5->setName('George Orwell')
            ->setBiography('English novelist, essayist, journalist and critic. His work is marked by lucid prose, social criticism, and opposition to totalitarianism.')
            ->setBirthDate(new \DateTimeImmutable('1903-06-25'));
        $manager->persist($author5);
        $this->addReference(self::AUTHOR_5_REFERENCE, $author5);

        // Jane Austen
        $author6 = new Author();
        $author6->setName('Jane Austen')
            ->setBiography('English novelist known primarily for her six major novels, which interpret, critique and comment upon the British landed gentry at the end of the 18th century.')
            ->setBirthDate(new \DateTimeImmutable('1775-12-16'));
        $manager->persist($author6);
        $this->addReference(self::AUTHOR_6_REFERENCE, $author6);

        // Ernest Hemingway
        $author7 = new Author();
        $author7->setName('Ernest Hemingway')
            ->setBiography('American novelist, short-story writer, and journalist. His economical and understated style had a strong influence on 20th-century fiction.')
            ->setBirthDate(new \DateTimeImmutable('1899-07-21'));
        $manager->persist($author7);
        $this->addReference(self::AUTHOR_7_REFERENCE, $author7);

        // Ray Bradbury
        $author8 = new Author();
        $author8->setName('Ray Bradbury')
            ->setBiography('American author and screenwriter, one of the most celebrated 20th-century American writers. He worked in various genres including fantasy, science fiction, and horror.')
            ->setBirthDate(new \DateTimeImmutable('1920-08-22'));
        $manager->persist($author8);
        $this->addReference(self::AUTHOR_8_REFERENCE, $author8);

        $manager->flush();
    }
}

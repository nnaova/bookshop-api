<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // J.K. Rowling's books
        $book1 = new Book();
        $book1->setTitle("Harry Potter and the Philosopher's Stone")
            ->setIsbn('9780747532699')
            ->setDescription('Harry Potter has never been the star of a Quidditch team, scoring points while riding a broom far above the ground. He knows no spells, has never helped to hatch a dragon.')
            ->setPrice('19.99')
            ->setPublishedAt(new \DateTimeImmutable('1997-06-26'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_1_REFERENCE, Author::class));
        $manager->persist($book1);

        $book2 = new Book();
        $book2->setTitle('Harry Potter and the Chamber of Secrets')
            ->setIsbn('9780747538493')
            ->setDescription("The Dursleys were so mean and hideous that summer that all Harry Potter wanted was to get back to the Hogwarts School for Witchcraft and Wizardry.")
            ->setPrice('21.99')
            ->setPublishedAt(new \DateTimeImmutable('1998-07-02'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_1_REFERENCE, Author::class));
        $manager->persist($book2);

        $book3 = new Book();
        $book3->setTitle('Harry Potter and the Prisoner of Azkaban')
            ->setIsbn('9780747542155')
            ->setDescription('Harry Potter is lucky to reach the age of thirteen, since he has survived the murderous attacks of the feared Dark Lord on more than one occasion.')
            ->setPrice('22.99')
            ->setPublishedAt(new \DateTimeImmutable('1999-07-08'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_1_REFERENCE, Author::class));
        $manager->persist($book3);

        // J.R.R. Tolkien's books
        $book4 = new Book();
        $book4->setTitle('The Hobbit')
            ->setIsbn('9780345339683')
            ->setDescription('Bilbo Baggins is a hobbit who enjoys a comfortable, unambitious life, rarely traveling farther than the pantry of his hobbit-hole in Bag End.')
            ->setPrice('24.99')
            ->setPublishedAt(new \DateTimeImmutable('1937-09-21'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_2_REFERENCE, Author::class));
        $manager->persist($book4);

        $book5 = new Book();
        $book5->setTitle('The Fellowship of the Ring')
            ->setIsbn('9780345339706')
            ->setDescription('One Ring to rule them all, One Ring to find them, One Ring to bring them all and in the darkness bind them.')
            ->setPrice('27.99')
            ->setPublishedAt(new \DateTimeImmutable('1954-07-29'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_2_REFERENCE, Author::class));
        $manager->persist($book5);

        $book6 = new Book();
        $book6->setTitle('The Two Towers')
            ->setIsbn('9780345339713')
            ->setDescription('Frodo and Sam continue their journey to Mordor with the treacherous Gollum as their guide.')
            ->setPrice('27.99')
            ->setPublishedAt(new \DateTimeImmutable('1954-11-11'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_2_REFERENCE, Author::class));
        $manager->persist($book6);

        // Isaac Asimov's books
        $book7 = new Book();
        $book7->setTitle('Foundation')
            ->setIsbn('9780553293357')
            ->setDescription('For twelve thousand years the Galactic Empire has ruled supreme. Now it is dying.')
            ->setPrice('16.99')
            ->setPublishedAt(new \DateTimeImmutable('1951-06-01'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_3_REFERENCE, Author::class));
        $manager->persist($book7);

        $book8 = new Book();
        $book8->setTitle('I, Robot')
            ->setIsbn('9780553382563')
            ->setDescription('The three laws of Robotics: 1) A robot may not injure a human being or, through inaction, allow a human being to come to harm.')
            ->setPrice('15.99')
            ->setPublishedAt(new \DateTimeImmutable('1950-12-02'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_3_REFERENCE, Author::class));
        $manager->persist($book8);

        // Agatha Christie's books
        $book9 = new Book();
        $book9->setTitle('Murder on the Orient Express')
            ->setIsbn('9780062693662')
            ->setDescription('Just after midnight, a snowdrift stops the Orient Express in its tracks. The luxurious train is surprisingly full for the time of the year.')
            ->setPrice('18.99')
            ->setPublishedAt(new \DateTimeImmutable('1934-01-01'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_4_REFERENCE, Author::class));
        $manager->persist($book9);

        $book10 = new Book();
        $book10->setTitle('And Then There Were None')
            ->setIsbn('9780062073488')
            ->setDescription('Ten strangers are lured to an isolated island mansion off the Devon coast by a mysterious host.')
            ->setPrice('17.99')
            ->setPublishedAt(new \DateTimeImmutable('1939-11-06'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_4_REFERENCE, Author::class));
        $manager->persist($book10);

        // George Orwell's books
        $book11 = new Book();
        $book11->setTitle('1984')
            ->setIsbn('9780451524935')
            ->setDescription('Among the seminal texts of the 20th century, Nineteen Eighty-Four is a rare work that grows more haunting as its futuristic purgatory becomes more real.')
            ->setPrice('19.99')
            ->setPublishedAt(new \DateTimeImmutable('1949-06-08'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_5_REFERENCE, Author::class));
        $manager->persist($book11);

        $book12 = new Book();
        $book12->setTitle('Animal Farm')
            ->setIsbn('9780451526342')
            ->setDescription('A farm is taken over by its overworked, mistreated animals. With flaming idealism and stirring slogans, they set out to create a paradise of progress, justice, and equality.')
            ->setPrice('14.99')
            ->setPublishedAt(new \DateTimeImmutable('1945-08-17'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_5_REFERENCE, Author::class));
        $manager->persist($book12);

        // Jane Austen's books
        $book13 = new Book();
        $book13->setTitle('Pride and Prejudice')
            ->setIsbn('9780141439518')
            ->setDescription('Since its immediate success in 1813, Pride and Prejudice has remained one of the most popular novels in the English language.')
            ->setPrice('12.99')
            ->setPublishedAt(new \DateTimeImmutable('1813-01-28'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_6_REFERENCE, Author::class));
        $manager->persist($book13);

        $book14 = new Book();
        $book14->setTitle('Sense and Sensibility')
            ->setIsbn('9780141439662')
            ->setDescription('Marianne Dashwood wears her heart on her sleeve, and when she falls in love with the dashing but unsuitable John Willoughby she ignores her sister Elinor\'s warning.')
            ->setPrice('12.99')
            ->setPublishedAt(new \DateTimeImmutable('1811-10-30'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_6_REFERENCE, Author::class));
        $manager->persist($book14);

        // Ernest Hemingway's books
        $book15 = new Book();
        $book15->setTitle('The Old Man and the Sea')
            ->setIsbn('9780684801223')
            ->setDescription('The Old Man and the Sea is one of Hemingway\'s most enduring works. Told in language of great simplicity and power.')
            ->setPrice('16.99')
            ->setPublishedAt(new \DateTimeImmutable('1952-09-01'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_7_REFERENCE, Author::class));
        $manager->persist($book15);

        $book16 = new Book();
        $book16->setTitle('A Farewell to Arms')
            ->setIsbn('9780684801469')
            ->setDescription('The best American novel to emerge from World War I, A Farewell to Arms is the unforgettable story of an American ambulance driver on the Italian front.')
            ->setPrice('18.99')
            ->setPublishedAt(new \DateTimeImmutable('1929-09-27'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_7_REFERENCE, Author::class));
        $manager->persist($book16);

        // Ray Bradbury's books
        $book17 = new Book();
        $book17->setTitle('Fahrenheit 451')
            ->setIsbn('9781451673319')
            ->setDescription('Guy Montag is a fireman. His job is to destroy the most illegal of commodities, the printed book, along with the houses in which they are hidden.')
            ->setPrice('17.99')
            ->setPublishedAt(new \DateTimeImmutable('1953-10-19'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_8_REFERENCE, Author::class));
        $manager->persist($book17);

        $book18 = new Book();
        $book18->setTitle('The Martian Chronicles')
            ->setIsbn('9781451678192')
            ->setDescription('The Martian Chronicles tells the story of humanity\'s repeated attempts to colonize the red planet.')
            ->setPrice('16.99')
            ->setPublishedAt(new \DateTimeImmutable('1950-05-04'))
            ->setAuthor($this->getReference(AuthorFixtures::AUTHOR_8_REFERENCE, Author::class));
        $manager->persist($book18);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AuthorFixtures::class,
        ];
    }
}

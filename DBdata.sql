-- Заполнение таблицы книг
INSERT INTO test_books (title) VALUES
    ('To Kill a Mockingbird'),
    ('1984'),
    ('The Lord of the Rings'),
    ('Pride and Prejudice'),
    ('The Great Gatsby'),
    ('The Da Vinci Code'),
    ('Life of Pi'),
    ('The Catcher in the Rye'),
    ('The Hobbit'),
    ('Fahrenheit 451'),
    ('Moby Dick'),
    ('The Odyssey'),
    ('Hamlet'),
    ('The Adventures of Huckleberry Finn'),
    ('Harry Potter and the Sorcerer\'s Stone'),
    ('War and Peace'),
    ('The Hunger Games'),
    ('The Chronicles of Narnia'),
    ('Alice in Wonderland'),
    ('Romeo and Juliet');

-- Заполнение таблицы авторов
INSERT INTO test_authors (name) VALUES
    ('Harper Lee'),
    ('George Orwell'),
    ('J.R.R. Tolkien'),
    ('Jane Austen'),
    ('F. Scott Fitzgerald'),
    ('Dan Brown'),
    ('Yann Martel'),
    ('J.D. Salinger'),
    ('John Steinbeck'),
    ('Ray Bradbury'),
    ('Herman Melville'),
    ('Homer'),
    ('William Shakespeare'),
    ('Mark Twain'),
    ('J.K. Rowling'),
    ('Leo Tolstoy'),
    ('Suzanne Collins'),
    ('C.S. Lewis'),
    ('Lewis Carroll'),
    ('Agatha Christie'),
    ('Ernest Hemingway'),
    ('Fyodor Dostoevsky'),
    ('Emily Brontë'),
    ('Gabriel García Márquez'),
    ('Aldous Huxley'),
    ('Virginia Woolf'),
    ('Edgar Allan Poe'),
    ('Charles Dickens'),
    ('Franz Kafka'),
    ('James Joyce');

-- Заполнение таблицы связи
INSERT INTO test_books_authors (book_id, author_id) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6),
    (7, 7),
    (8, 8),
    (9, 2),
    (1, 2),
    (2, 3),
    (3, 4),
    (4, 5),
    (5, 6),
    (6, 7),
    (7, 8),
    (8, 9),
    (9, 2),
    (10, 9),
    (11, 10),
    (12, 11),
    (13, 12),
    (14, 13),
    (15, 14),
    (16, 15),
    (17, 16),
    (18, 17),
    (19, 18),
    (20, 12)

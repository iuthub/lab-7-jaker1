SELECT * FROM movies WHERE year='1995'
SELECT COUNT(*) FROM roles AS r JOIN movies AS m ON r.movie_id = id WHERE m.name='Lost in Translation'
SELECT first_name, last_name, name FROM actors JOIN roles ON roles.actor_id = actors.id JOIN movies ON roles.movie_id=movies.id WHERE movies.name='Lost in Translation'
SELECT first_name, last_name, name FROM directors JOIN movies_directors ON directors.id=movies_directors.director_id JOIN movies ON movie_id=movies.id WHERE movies.name='Fight Club'
SELECT COUNT(*) FROM movies JOIN movies_directors ON movies_directors.movie_id=movies.id JOIN directors ON movies_directors.director_id=directors.id WHERE directors.first_name='Clint' AND directors.last_name='Eastwood'
SELECT name FROM movies JOIN movies_directors ON movies_directors.movie_id=movies.id JOIN directors ON movies_directors.director_id=directors.id WHERE directors.first_name='Clint' AND directors.last_name='Eastwood'
SELECT first_name, last_name AS name FROM directors JOIN directors_genres AS dg ON dg.director_id=id WHERE genre='Horror'
SELECT * FROM actors JOIN roles ON actor_id=actors.id JOIN movies_directors ON roles.movie_id = movies_directors.movie_id JOIN directors ON directors.id=movies_directors.director_id WHERE directors.first_name='Christopher' AND directors.last_name='Nolan'

-- 8 tasks in 8 lines
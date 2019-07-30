select name, count_books, max(positive_rating)
from (
	select a.name, 
		count(b.id) over (PARTITION BY b.author_id) as count_books, 
		case when rating >= 4.0 then 1 else 0 end as positive_rating
	from books as b
	left join authors as a on b.author_id = a.id
) as main
group by name, count_books
order by count_books asc;

select name, count_books, max(positive_rating), sum(positive_rating) as count_positive_rating_books
from (
	select a.name, 
		count(b.id) over (PARTITION BY b.author_id) as count_books, 
		case when rating >= 4.0 then 1 else 0 end as positive_rating
	from books as b
	left join authors as a on b.author_id = a.id
) as main
group by name, count_books
having sum(positive_rating) > 1
order by count_books asc

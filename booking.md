

Rest

Id
name
start
end_time

Tables
id
table_id
Rest_id
capaciy
location
is_booked 


table_time_slots

id
rest_id
start_time
end_time

booking table
id
table_id
userId
Reservation_date
slot_id


select * from table_time_slots  inner join  Tables on Tables.id= table_id  where table_time_slots.start_time > date_from_qury  Tables.capacit = capacity_from_qury and Tables.is_booked !=1




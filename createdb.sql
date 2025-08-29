CREATE TABLE users (
  id int(11) NOT NULL,
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp()
)

CREATE TABLE posts (
  id int(11) NOT NULL,
  user_id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  rating int(11) DEFAULT 0,
  created_at timestamp NOT NULL DEFAULT current_timestamp()
)

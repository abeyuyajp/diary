# diary

## postsテーブル

| Column             | Type        |
| ------------------ | ----------- |
| user_id            | bigInteger  |
| image              | string      |
| title              | string      |
| text               | text        |
| published          | datetime    |



## usersテーブル

| Column             | Type        |
| ------------------ | ----------- |
| name               | string      |
| email              | string      |
| password           | string      |



## commentsテーブル

| Column             | Type        |
| ------------------ | ----------- |
| post_id            | bigInteger  |
| user_id            | bigInteger  |
| text               | text        |

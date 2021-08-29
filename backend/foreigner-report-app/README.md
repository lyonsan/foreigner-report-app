# テーブル設計

## usersテーブル

| column    | type        |                   |
|-----------|-------------|-------------------|
| id        | integer     | null: false       |
| user_name | string      | null: false       |
| email     | string      | null: false       |
| language  | string      |                   |
| school    | string      |                   |
| birthday  | date        | null: false       |
| edu_org   | string      |                   |
| user_role | string      | null: false       |

ユーザー新規登録画面
・小中学生：
　名前、生年月日、ユーザーID、パスワード、使用言語、通っている小中学校・地域日本語教室
・指導者：
　名前、メールアドレス、ユーザーID、パスワード、生年月日、所属
・親：
　名前、メールアドレス、ユーザーID、パスワード、生年月日、使用言語
## study_reportsテーブル

| column         | type        |               |
|----------------|-------------|---------------|
| id             | integer     | null: false   |
| reference_book | string      |               |
| report_child   | string      | null: false   |
| tomorrow_plan  | string      | null: false   |
| report_teacher | string      | null: false   |
| child_id       | integer     | null: false   |
| teacher_id     | integer     | null: false   |

## comment_reportsテーブル

| column          | type        |               |
|-----------------|-------------|---------------|
| id              | integer     | null: false   |
| comment_content | string      | null: false   |
| report_id       | integer     | null: false   |
| parent_id       | integer     | null: false   |


## teacher_chatroomsテーブル

| column          | type        |               |
|-----------------|-------------|---------------|
| id              | integer     | null: false   |
| child_id        | integer     | null: false   |


## chatrooms_authsテーブル

| column          | type        |               |
|-----------------|-------------|---------------|
| id              | integer     | null: false   |
| auth_id         | integer     | null: false   |
| chatroom_id     | integer     | null: false   |


## teacher_chatsテーブル

| column          | type        |               |
|-----------------|-------------|---------------|
| id              | integer     | null: false   |
| chat_content    | string      | null: false   |
| chatroom_id     | integer     | null: false   |
| auth_id         | integer     | null: false   |
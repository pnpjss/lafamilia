# Hacker News

```
git clone https://github.com/pnpjss/lafamilia.git
```

```
$ navigate to folder
```

```
$ php -S localhost:8000
```

## User stories

- [x] As a user I should be able to create an account.

- [x] As a user I should be able to login.

- [x] As a user I should be able to logout.

- [x] As a user I should be able to edit my account email, password and biography.

- [x] As a user I should be able to upload a profile avatar image.

- [x] As a user I should be able to create new posts with title, link and description.

- [x] As a user I should be able to edit my posts.

- [x] As a user I should be able to delete my posts.

- [x] As a user I'm able to view most upvoted posts.

- [x] As a user I'm able to view new posts.

- [x] As a user I should be able to upvote posts.

- [x] As a user I should be able to remove upvote from posts.

- [x] As a user I'm able to comment on a post.

- [x] As a user I'm able to edit my comments.

- [x] As a user I'm able to delete my comments.

## Some features

- Password changes will be tried against the database

- Deleting user will delete all likes, posts and comments as well

- During registration, password input will be confirmed

- Images will be stored with unique id's to ensure their names dont interfere

- Registration tests availability for email and username against the database

### tested by:

Joakim Sjögren

Ida From

### code review by Erik White:

- Consider removing commented CSS code before handing in. 'style.css' for an example.

- Bio-container in mobile views goes a bit out off-screen.

- You might want to format your code for better readability. Index.php @ line 27- for an example.

- In that same place you could save yourself some typing by placeing PHP-code within the same opening -and closing tags.

- Thumbs up when downvoting, and thumbs down when upvoting. I recall you mentioning this, but for the sake of documentation, haha.

- Good job with function to delete account. Didn't manage this myself in time. Consider using some sort of messege.confirm to confirm this descision,
  so the user don't accidently delete his or her account.

- Cool use of getRandomKey (posts.php @ line 17). Never thought of this before. In the end, I'm not sure what would be the most secure option. One way I went for was to
  check is us userId matches with the content.

- You might want to include images folder in the .gitignore to to not clutter you repo with images.

- Good use with /.vscode/ json settings -and extensions. Something I forgot all about.

- In the index.php you a PDO query that might be better off in the functions.php. But that's just my preference.

- Over all, very good job! You solved it well without confusing yourself with tons of JS like I did.

### Backlog

- Code cleanup

- Main/section in html and css

- Adding comments in code

- Messages on page actions

- Css cleanup

- Footer

- Filter corrections

- Function strict types and return values

## Added Features

- As a user i'm able to reply to comments.

- As a user i'm able to upvote and remove upvote on comments.

- Link to pull request: https://github.com/pnpjss/lafamilia/pull/1


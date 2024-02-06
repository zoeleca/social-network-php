$laQuestionEnSql = "
SELECT users.*,
count(DISTINCT posts.id) as totalpost,
count(DISTINCT given.post_id) as totalgiven,
count(DISTINCT recieved.user_id) as totalrecieved
FROM users
LEFT JOIN posts ON posts.user_id=users.id
LEFT JOIN likes as given ON given.user_id=users.id
LEFT JOIN likes as recieved ON recieved.post_id=posts.id
WHERE users.id = '$userId'
GROUP BY users.id
";
$lesInformations = $mysqli->query($laQuestionEnSql);

if ( ! $lesInformations)
{
echo("Échec de la requete : " . $mysqli->error);
exit();
}
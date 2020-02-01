package main

import (
	_ "github.com/go-sql-driver/mysql"
	"database/sql"
	"fmt"
)


/*
DELETE agenda.*, servicos_agenda.*  FROM agenda
LEFT JOIN servicos_agenda ON servicos_agenda.idAgenda = agenda.idAgenda
WHERE agenda.data < (CURDATE() - INTERVAL 7 DAY)
 */

func main() {
	db, err := sql.Open("mysql", "root:r007385rpg@tcp(localhost:3306)/appTcc?charset=utf8")
	checkErr(err)

	/*// insert
	stmt, err := db.Prepare("INSERT userinfo SET username=?,departname=?,created=?")
	checkErr(err)

	res, err := stmt.Exec("rodrigo", "ti", "2012-12-09")
	checkErr(err)

	id, err := res.LastInsertId()
	checkErr(err)

	fmt.Println(id)


	// update
	stmt, err := db.Prepare("update userinfo set username=? where uid=?")
	checkErr(err)

	res, err := stmt.Exec("testefdsfsdf", 1)
	checkErr(err)

	affect, err := res.RowsAffected()
	checkErr(err)

	fmt.Println(affect)

	// query
	rows, err := db.Query("SELECT * FROM userinfo")
	checkErr(err)

	for rows.Next() {
		var uid int
		var username string
		var department string
		var created string
		err = rows.Scan(&uid, &username, &department, &created)
		checkErr(err)
		fmt.Println(uid)
		fmt.Println(username)
		fmt.Println(department)
		fmt.Println(created)
	}
*/
	// delete
	stmt, err := db.Prepare("DELETE agenda.*, servicos_agenda.*  FROM agenda LEFT JOIN servicos_agenda ON servicos_agenda.idAgenda = agenda.idAgenda	WHERE agenda.data < (CURDATE() - INTERVAL ? DAY)")
	checkErr(err)

	res, err := stmt.Exec(7)
	checkErr(err)

	affect, err := res.RowsAffected()
	checkErr(err)

	fmt.Println(affect)

//	db.Close()
	defer  db.Close()

}

func checkErr(err error) {
	if err != nil {
		panic(err)
	}
}
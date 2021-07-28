<!DOCTYPE html>
<html>
<title>Game XO with bot</title>

<head >
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src = "test.js" ></script>
</head>


<body class='content'>
    <div id='first-div'>
        <div>
            <label for="num_xo" id="text_num">Table Size : </label>
            <input type="number" id="num_xo" min=3>
            <button onclick="changeXO()" id="play">Change!</button>
        </div>
        <div id='table-div'>
            <table class='content' id="test">
            </table>
        </div>
        <div id="div-replay" >

        </div>

    </div>

    <script>
        let tableGame;
        let num_size;
        var board = [];
        let change ; 
        let changetxt ;
        let win ; 

        function changeXO() {
            let num_xo = document.getElementById("num_xo").value;
            if (num_xo == NaN || num_xo < 3) {
                alert("ใส่ขนาดตารางน้อยไปหรือไม่ได้ใส่ขนาดตาราง");
            } else {
                num_size = document.getElementById("num_xo").value;
                num_size = parseInt(num_size);
                change = [] ;
                changetxt = '';
                addmorerow(num_xo);
                for(let i = 0 ; i < num_xo**2 ; i++) {
                    board[i] = 0;
                }
            }
        }
        //create table for xo-game
        function addmorerow(n) {
            let tb = document.getElementById('test');
            tb.innerHTML = "";
            let count = -1;
            for (let a = 0; a < n; a++) {
                let tr = document.createElement('tr');
                for (let i = 1; i <= n; i++) {
                    count++;
                    let idtext = "td" + count;
                    let td = document.createElement('td');
                    let button = document.createElement('button');
                    td.setAttribute("id", idtext);
                    td.setAttribute("onClick", "checkclick(this.id)");
                    td.setAttribute('class','idgame');
                    tr.appendChild(td);
                }
                tb.appendChild(tr);
            }
            round = 0 ;
        }
        function checkclick(id) {
            let textid = id ; 
            let selectbox = document.getElementById(id);

            selectbox.innerHTML = "X";
            selectbox.style.color = 'blue';
            selectbox.setAttribute("OnClick","");
            change.push(parseInt(textid.slice(2))); 
            changetxt = changetxt  +parseInt(textid.slice(2)) + ",";
            board[parseInt(textid.slice(2))] = 1;
            updateboard(parseInt(textid.slice(2))) ; 

        }
        

        function updateboard(id) {
            // gameover insert data 
            if(possiblemove(board,num_size).length==0){
                alert("Tie");
                changetext();
                win = 0;
                window.open("http://localhost/xogame/insert.php?win="+win+"&move="+changetxt+"&size="+num_size);
                window.location.reload();
            } else {
                let move = minimax(board,num_size,-1);
                board[move.index] = -1;
                let text_id = 'td'+move.index;
                let botselect = document.getElementById(text_id);
                botselect.innerHTML = "O";
                botselect.style.color = 'red';
                botselect.setAttribute("OnClick","");
                change.push(move.index); 
                changetxt = changetxt  + move.index + ",";
                if(checkwin(board,num_size) == 1) {
                    alert("You win!");
                    win = 1 ; 
                    changetext();
                    window.open("http://localhost/xogame/insert.php?win="+win+"&move="+changetxt+"&size="+num_size);
                    window.location.reload();
                }else if(checkwin(board,num_size) == -1) {
                    alert("You Lose !");
                    changetext();
                    win = -1 ;
                    window.open("http://localhost/xogame/insert.php?win="+win+"&move="+changetxt+"&size="+num_size);
                    window.location.reload();
                }
            }
            console.log(change);
            console.log(changetxt);

        }

        function changetext(){
            document.getElementById('play').innerHTML = "Play More !";
            console.log(board); 
        }
    </script>


         
    <div id='sec-div'>
    <table class="table" id="data-table">
  <thead class="thead-dark">
    <tr >
      <th scope="col">id</th>
      <th scope="col">whowin</th>
      <th scope="col">size</th>
      <th scope="col">move</th>
    </tr>
  </thead>
        <?php 
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        
        $mysqli = new mysqli($servername, $username, "", "xogame");
         
        // Check connection
        if($mysqli === false){
            die("ERROR: Could not connect. " . $mysqli->connect_error);
        }$sql = "SELECT * FROM game_1";
        if($result = $mysqli->query($sql)){
            if($result->num_rows > 0){
                $count = 0;
                while($row = $result->fetch_array()){
                    $count++;
                        echo "<tr id='row" . $count . "'>";
                        echo "<td>" . $count . "</td>";
                        if($row['win']==-1) {
                            echo "<td>O</td>";
                        }else if($row['win'] ==1){
                            echo "<td>X</td>";
                        }else {
                            echo "<td>Tie</td>";
                        }
                        echo "<td>" . $row['size'] . "</td>";
                        echo "<td>" . $row['move'] . "</td>";
                    echo "</tr>";
                }
                // Free result set
                $result->free();
            } else{
                echo "No records matching your query were found.";
            }
        
        }
        ?>
    </table>
    </div>


    <script>
        // create data in replay table and set id 
        let numTr = document.getElementById('data-table').getElementsByTagName('tr').length-1;
        for(let i = 0 ; i<numTr ; i++ ){
            let p = document.getElementById('row'+(i+1));
            p.setAttribute('onclick','replaydelay(this.id)');
        }


        function replay(id){
            let test = document.getElementById(id);
            let size_table = test.children[2].innerHTML;
            let str_move = test.children[3].innerHTML.split(",");
            addmorerow(size_table);
            let ss = 0; 
            str_move.pop();
            console.log(test.children[2].innerHTML);
            console.log(str_move);
            return str_move     
        }
        function replaydelay(id) {            
            let re = replay(id);
            
            for(let i = 0 ; i < re.length ; i++) {
                let id = "td" + re[i] ;
                  if(i%2== 1) {
                    console.log("check : " + i);
                    changereplay(id,'O',i);
                }else{
                    changereplay(id,'X',i);
                }              
            }
        }

        function changereplay(id,player,i) {
            //delay 1 s 
            setTimeout(function() {
            document.getElementById(id).innerHTML = player; 
            if(player == 'X') {
                document.getElementById(id).style.color = 'blue'; 
            }else{
                document.getElementById(id).style.color = 'red'; 
            }
            }, 1000 * i);
        }

    </script>
</body>

</html>
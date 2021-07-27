<!DOCTYPE html>
<html>
<title>Game XO with bot</title>

<head >
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <h1>เปลี่ยนขนาด : </h1> -->
    <script src = "test.js" ></script>
    <!-- <script src = "bot.js" ></script> -->
</head>


<body class='content'>
    <div id='first-div'>
        <div>
            <label for="num_xo" id="text_num">เปลี่ยนขนาด : </label>
            <input type="number" id="num_xo" min=3>
            <button onclick="changeXO()" id="play">Change!</button>
            <!-- <button onclick="cleartable()">Clear!</button> -->
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
            // alert(num_xo);
            if (num_xo == NaN || num_xo < 3) {
                alert("ใส่ขนาดตารางน้อยไปหรือไม่ได้ใส่ขนาดตาราง");
            } else {
                num_size = document.getElementById("num_xo").value;
                num_size = parseInt(num_size);
                // alert(num_size);
                change = [] ;
                changetxt = '';
                addmorerow(num_xo);
                for(let i = 0 ; i < num_xo**2 ; i++) {
                    board[i] = 0;
                }
                // alert(board.length)
                // alert(board[board.length-1])
            }
        }
        function addmorerow(n) {
            let tb = document.getElementById('test');
            tb.innerHTML = "";
            // alert(n);
            // var tb = document.createElement('table')
            let count = -1;
            for (let a = 0; a < n; a++) {
                let tr = document.createElement('tr');
                for (let i = 1; i <= n; i++) {
                    // alert(n);
                    count++;
                    let idtext = "td" + count;
                    let td = document.createElement('td');
                    let button = document.createElement('button');
                    td.setAttribute("id", idtext);
                    td.setAttribute("onClick", "checkclick(this.id)");
                    td.setAttribute('class','idgame');
                    // button.setAttribute('id', idtext);
                    // button.setAttribute('onClick',"checkclick()")
                    // button.innerHTML = "Select"

                    // td.appendChild(button);
                    // td.innerHTML = "test";
                    tr.appendChild(td);
                }
                tb.appendChild(tr);
            }
            round = 0 ;
        }
        function checkclick(id) {
            // alert("test");
            let textid = id ; 
            let selectbox = document.getElementById(id);
            // alert(parseInt(textid.slice(2)));
            selectbox.innerHTML = "X";
            selectbox.setAttribute("OnClick","");
            change.push(parseInt(textid.slice(2))); 
            changetxt = changetxt  +parseInt(textid.slice(2)) + ",";
            // sleep(1000);
            // board[id] = "X";
            board[parseInt(textid.slice(2))] = 1;
            // console.log(parseInt(textid.slice(2)));

            updateboard(parseInt(textid.slice(2))) ; 

        }
        

        function updateboard(id) {
            // board[id] = 1;
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
                        // print_r(explode("l",$row['move']));
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
                        // print_r("<td>" . explode("l",$row['move']) . "</td>");  
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
    <div id="div-replay" style="visibility: hidden;">
        <button id ="back" >back</button>
        <button id ="next" >next</button>
    </div>

    <script>
        // for(let i = 0 ; i < )
        let numTr = document.getElementById('data-table').getElementsByTagName('tr').length-1;
        // console.log(chack.getElementsByTagName('tr').length-1);
        // p.setAttribute('onclick','alert()');
        for(let i = 0 ; i<numTr ; i++ ){
            let p = document.getElementById('row'+(i+1));
            p.setAttribute('onclick','replaydelay(this.id)');
            // console.log(p);
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
            // for(let i = 0 ; i < str_move.length ; i++) {
            //     let id = "td" + str_move[i] ;
            //       if(i%2== 1) {
            //         // document.getElementById(id).innerHTML = "X";
            //         // changereplay(id,'X');
            //         return 'X';
            //     }else{
            //         // document.getElementById(id).innerHTML = "O";
            //         // changereplay(id,'O');
            //         return 'O';
            //     }

            //     // console.log(id);
                
            // }
            
        }
        function replaydelay(id) {
            // changereplay(id,play)
            
            let re = replay(id);
            
            for(let i = 0 ; i < re.length ; i++) {
                let id = "td" + re[i] ;
                  if(i%2== 1) {
                    // document.getElementById(id).innerHTML = "X";
                    changereplay(id,'X');
                }else{
                    // document.getElementById(id).innerHTML = "O";
                    changereplay(id,'O');
                }              
            }
            // changereplay(id,player);
            
        }

        function changereplay(id,player) {
            // resEle.innerHTML += "i = " + i + "<br>"            
            document.getElementById(id).innerHTML = player; 
            // document.getElementById(id).innerHTML = player; 
            
        }



    </script>

        <!-- <table class="table">
  <thead class="thead-dark">
    <tr onclick="alert('test')">
      <th scope="col"></th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
    </table> -->

    <!-- <table class="table">
  <thead class="thead-dark">
    <tr >
      <th scope="col"></th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr onclick="alert('test')" class="table-active">
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr class="table-active">
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr class="table-active">
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->


   


</body>

</html>
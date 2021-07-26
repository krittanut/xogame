<!DOCTYPE html>
<html>
<title>Game XO with bot</title>

<head >
    <link rel="stylesheet" href="style.css">
    <!-- <h1>เปลี่ยนขนาด : </h1> -->
    <script src = "test.js" ></script>
    <!-- <script src = "bot.js" ></script> -->
</head>

<body class='content'>
    <div id='first-div'>
        <div>
            <label for="num_xo" id="text_num">เปลี่ยนขนาด : </label>
            <input type="number" id="num_xo" min=3>
            <button onclick="changeXO()">Change!</button>
            <!-- <button onclick="cleartable()">Clear!</button> -->
        </div>
        <div id='table-div'>
            <table class='content' id="test">
            </table>
        </div>

</div>



    <script>
        let tableGame;
        let num_size;
        var board = [];

        function changeXO() {
            let num_xo = document.getElementById("num_xo").value;
            // alert(num_xo);
            if (num_xo == NaN || num_xo < 3) {
                alert("ใส่ขนาดตารางน้อยไปหรือไม่ได้ใส่ขนาดตาราง");
            } else {
                num_size = document.getElementById("num_xo").value;
                num_size = parseInt(num_size);
                // alert(num_size);
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
                    // button.setAttribute('id', idtext);
                    // button.setAttribute('onClick',"checkclick()")
                    // button.innerHTML = "Select"

                    // td.appendChild(button);
                    // td.innerHTML = "test";
                    tr.appendChild(td);
                }
                tb.appendChild(tr);
            }
        }

        function checkclick(id) {
            // alert("test");
            let textid = id ; 
            let selectbox = document.getElementById(id);
            // alert(parseInt(textid.slice(2)));
            selectbox.innerHTML = "X";
            // board[id] = "X";
            board[parseInt(textid.slice(2))] = 1;
            // console.log(parseInt(textid.slice(2)));
            updateboard(parseInt(textid.slice(2))) ; 

        }

        function updateboard(id) {
            // board[id] = 1;
            if(possiblemove(board,num_size).length==0){
                alert("Tie");
                changeXO();
            } else {
                let move = minimax(board,num_size,-1);
                board[move.index] = -1;
                let text_id = 'td'+move.index;
                let botselect = document.getElementById(text_id);
                botselect.innerHTML = "O";
                if(checkwin(board,num_size) == 1) {
                    alert("You win!");
                    changeXO();
                }else if(checkwin(board,num_size) == -1) {
                    alert("You Lose !");
                    changeXO();
                }
            }


            console.log(board);
        }



    </script>
</body>

</html>
// X == 1
// O == -1
// not pick == 0 
// var test = [ 1, 0, 0, 1,
//              1, 0, 0, 1,
//              1, 0, 0, 1,
//              1, 1, 1, 1];

// checkwin(test,6,4);
// var test3 = [1,1,1,
//             0,0,0,
//             0,0,0]
let human = 1;
let com = -1;

var test4 = [ 1, 1, 1, 1,
             0, 0, 0, 0,
             0, 0, 0, 0,
             0, 0, 0, 0];
// console.log(checkwin(test4,4));
// console.log("asdsadsa : " + c);

function checkwin(checkboard,sizexo) {
    let allposible =  allposiblewin(sizexo) ;
    // console.log(allposible); 
    // console.log(allposible);
    for(let i in allposible) {
        let count = 0;
        // console.log(allposible[i]);
        for(let b = 0 ; b < sizexo ; b++) {
            // console.log(allposible[i][b]);
            // console.log(checkboard[allposible[i][b]]);
            count+=checkboard[parseInt(allposible[i][b])];
        }
        // console.log("total  :  " + count);
        // whowin(count,sizexo); 
        if(whowin(count,sizexo) == 1 ){
            // console.log("You win ! ");
            return 1 
        }else if(whowin(count,sizexo) == -1 ){
            return -1 
        }
        // else {
        //     return 0
        // }
        // console.log("return : " + whowin(count,sizexo));
        
    }

}


// allposiblewin(5);
function allposiblewin(sizexo) {
    let allpossible = []
    //vertical
    for(let i = 0 ; i < sizexo ; i ++) {
        // console.log(i);
        let numupdate = i ; 
        let all = [] 
        for(let b = 0 ; b <sizexo ; b++) {
            // console.log(numupdate );
            all[b] = numupdate; 
            numupdate+=sizexo;
 
        }
        allpossible.push(all);
    }
    // console.log(allvertical); 

    // horizon 
    for(let i = 0 ; i <sizexo ; i++) {
        let all = [] 
        for(let b = 0 ; b < sizexo ; b++) {
            // console.log(b + (sizexo * i));
            all.push(b + (sizexo * i));
        }
        allpossible.push(all);
        // console.log(all);
    }
    // console.log(allpossible);
    //diago 
    for(let i = 0 ; i < 2 ; i++) {
        let all = [] ;
        if(i != 0 ) {
            let diago1 = sizexo-1;
        }
        for (let b = 0 ; b < sizexo ;b ++) {
            if ( i == 0 ) {
                // console.log(b * (sizexo +1));
                all.push(b * (sizexo +1));
            }else {
                // console.log((sizexo-1)*(b+1));
                all.push((sizexo-1)*(b+1));
            }

        }
        // console.log(all);
        allpossible.push(all);
    }
    // console.log(allpossible.length);
    return allpossible 
}


function whowin(count,sizexo) {
    if(count  == sizexo){
        // console.log("X WINNN"); 
        // window.alert("X WINNNN");
        return 1 
    }else if(count  == -sizexo) {
        // console.log("O WINNN");
        // window.alert("O WINNN");
        return -1
     }
    // else{
    //     // console.log("Noone win in this move");
    //     return 0 
    //     // window.alert("Noone win in this move");
    // }
}


let testtt = [1,0,0,
              1,0,0,
              0,0,0 ];

// possiblemove(testtt,3);

function possiblemove(board,sizexo) {
    let space = [] ; 
    for(let i = 0 ; i<sizexo**2 ; i++) {
        // console.log(i);
        if(board[i] == 0 ) {
            space.push(i) ;
        }
        // console.log("Board : " +  board[i]);
         
    }
    // console.log(space) ;
    // botselecet(board,sizexo,space) ;
    return space 
}






let depth = 0 ; 
// var score = 100 ;
//calculate one case 
function minimax(currentboard,sizexo,player) {
    let ar = possiblemove(currentboard,sizexo)
    // console.log(currentboard);
    if(checkwin(currentboard,sizexo) == com) {
        // console.log('win');
        return {score :  10 };
    }else if(checkwin(currentboard,sizexo) == human) {
        return {score : -10};
    }
    else if(ar.length == 0){
        // console.log("test");
        return {score : 0};
    }
    var moves =  [] ; 
    // console.log("check");
    
    for(var i = 0 ; i < ar.length ; i++) {
        var move = {};
        move.index = ar[i];
        // console.log("first : " + move.index);
        currentboard[ar[i]] = player; 
        if(player == com) {
            var result = minimax(currentboard,sizexo,human);
            move.score = result.score ; 
        }else{
            var result = minimax(currentboard,sizexo,com);
            move.score = result.score ; 
        }
        
        
        currentboard[ar[i]] = 0 ; 
        // console.log("Secound : " + move.index);
        moves.push(move) ;
    }
        var bestMove; 
        if(player === com) {
            var bestScore = -10000; 
            for(var i = 0 ;i < moves.length; i++) {
                if(moves[i].score > bestScore) {
                    bestScore = moves[i].score;
                    bestMove = i ;
                }
            }
        }else{
            var bestScore = 10000;
            for(var i = 0 ; i<moves.length;i++) {
                if(moves[i].score < bestScore) {
                    bestScore = moves[i].score; 
                    bestMove = i ;
                }
            }
        }
    // console.log(currentboard);
    // minimax(currentboard,sizexo,possiblemove(currentboard,3)[0])
    // console.log(moves[bestMove]);
    // console.log(moves[bestMove]);
    // console.log(bestScore);
    return moves[bestMove]
}

test10  =   [1, 1, 1, 0,
             0, 0, -1, -1,
             0, 0, 0, 0,
             0, 0, 0, 0] 

// test11 = [1, 1, -1,
//           0, 0, -1,
//           0, 0, 1]
t = minimax(test10,4,-1);
console.log(t);
// console.log(t);

// console.log(possiblemove(test10,3));

// console.log(possiblemove(test10,3).length);
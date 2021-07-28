// X == 1
// O == -1
// not pick == 0 
let com = -1 ;
let human = 1; 


function checkwin(checkboard,sizexo) {
    let allposible =  allposiblewin(sizexo) ;

    for(let i in allposible) {
        let count = 0;
        let match = [];
        for(let b = 0 ; b < sizexo ; b++) {
            match.push(allposible[i][b]);
            count+=checkboard[parseInt(allposible[i][b])];
        }
        if(whowin(count,sizexo) == 1 ){
            return 1 
        }else if(whowin(count,sizexo) == -1 ){
            return -1 
        }
    }

}

//find possible win in board
function allposiblewin(sizexo) {
    let allpossible = []
    for(let i = 0 ; i < sizexo ; i ++) {
        let numupdate = i ; 
        let all = [] 
        for(let b = 0 ; b <sizexo ; b++) {
            all[b] = numupdate; 
            numupdate+=sizexo;
 
        }
        allpossible.push(all);
    }

    // horizon 
    for(let i = 0 ; i <sizexo ; i++) {
        let all = [] 
        for(let b = 0 ; b < sizexo ; b++) {
            all.push(b + (sizexo * i));
        }
        allpossible.push(all);
    }
    //diago 
    for(let i = 0 ; i < 2 ; i++) {
        let all = [] ;
        if(i != 0 ) {
            let diago1 = sizexo-1;
        }
        for (let b = 0 ; b < sizexo ;b ++) {
            if ( i == 0 ) {
                all.push(b * (sizexo +1));
            }else {
                all.push((sizexo-1)*(b+1));
            }

        }
        allpossible.push(all);
    }
    return allpossible 
}

// check who win with sum of value in possiblewin index 
function whowin(count,sizexo) {
    if(count  == sizexo){
        return 1 
    }else if(count  == -sizexo) {
        return -1
     }
}


function possiblemove(board,sizexo) {
    let space = [] ; 
    for(let i = 0 ; i<sizexo**2 ; i++) {
        if(board[i] == 0 ) {
            space.push(i) ;
        }
         
    }
    return space 
}

function minimax(currentboard,sizexo,player) {
    let ar = possiblemove(currentboard,sizexo)
    if(checkwin(currentboard,sizexo) == com) {
        return {score :  10 };
    }else if(checkwin(currentboard,sizexo) == human) {
        return {score : -10};
    }
    else if(ar.length == 0){
        return {score : 0};
    }
    var moves =  [] ; 
    
    for(var i = 0 ; i < ar.length ; i++) {
        var move = {};
        move.index = ar[i];
        currentboard[ar[i]] = player; 
        if(player == com) {
            var result = minimax(currentboard,sizexo,human);
            move.score = result.score ; 
        }else{
            var result = minimax(currentboard,sizexo,com);
            move.score = result.score ; 
        }
        currentboard[ar[i]] = 0 ; 
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

    return moves[bestMove]
}

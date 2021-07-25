
function letbotmove(board,sizexo) {
    possiblemove(board,sizexo) ;
}
let testtt = [1,0,0,
              1,0,0,
              0,0,0 ];
possiblemove(testtt,3);

function possiblemove(board,sizexo) {
    let space = [] ; 
    for(let i = 0 ; i<sizexo**2 ; i++) {
        // console.log(i);
        if(board[i] == 0 ) {
            space.push(i) ;
        }
        console.log("Board : " +  board[i]);
         
    }
    console.log(space) ;
    botselecet(board,sizexo,space) ;
    
}

function botselecet(currentboard,sizexo,space) {
    const state = 0 ; 
    const depth = 0 ; 
    const scoreeachcase = 0 ; 
    const finish = true;
    for(let i = 0 ; i < space.length ; i++ ) {
        console.log(space[i]);
        while(finish) {
            currentboard
        }
    }
}
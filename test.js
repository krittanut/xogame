const cars = ["Saab", "Volvo", "BMW","",""];
console.log(cars);
console.log(availableMove(cars));

// for(let i = 0 ;i < cars.length ; i++) {
//     if(cars[i] == "") {
//         console.log(cars[i] + "Find Something")    
//     }
// }

function availableMove(board){
    var available = []
    var count = 0 ; 
    for(let i = 0 ; i < board.length ; i++) {
        if(board[i] == "") {
            available[count] = board[i] ;   
            count++;
        }
        
    }
    return available
}
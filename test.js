const cars = ["Saab", "Volvo", "BMW", "", ""];
console.log(cars);
console.log(availableMove(cars));

var sizexo = 3;

function availableMove(board) {
    var available = []
    var count = 0;
    for (let i = 0; i < board.length; i++) {
        if (board[i] == "") {
            available[count] = board[i];
            count++;
        }

    }
    return available
}
// X == 1
// O == -1
// not pick == 0 
// var test = [ -1, 1, 1,
//              -1, -1, 1,
//              1, -1, -1];

// checkwin(test,8);

function checkwin(checkboard,num) {
    var vertical = 0;
    var horizon = 0;  
    var diago = 0 ;

    // checkFirstValue  3 possible vertical horizon diagonal
    if(num == 0) {
        // check left top conner 
        for(let i = 0 ; i < sizexo ; i ++) {
            // vertical index 0 
            console.log("vertical " + checkboard[i] );
            vertical+=checkboard[i];
            console.log(vertical);
            // horizon index  0
            console.log("horizon " + checkboard[i*sizexo] );
            horizon+=checkboard[i*3];
            console.log(horizon);
            // 
            console.log("diago " + checkboard[i*(sizexo+1)] );
            diago+=checkboard[i*4];
            console.log(diago);

            // if(vertical  == 3 || horizon == 3 || diago == 3 ){
            //     console.log("X WINNNN"); 
            // }else if(vertical  == -3 || horizon == -3 || diago == -3 ) {
            //     console.log("O WINNN");
            // }else {
            //     console.log("No one win in thsi move");
            // }
            whowin(vertical,horizon,diago);

            }
        }
    else if(num/sizexo == sizexo-1 ) {
        //check left bottom conner
        for(let i = 0; i<sizexo ; i ++) {            
            // console.log(" Check num+i " + (num+i));
            console.log("vertical " + checkboard[i*sizexo] );
            vertical+=checkboard[i*sizexo];
            console.log("Check number   :  " + (i*sizexo));
            console.log(vertical);

            console.log("horizon " + checkboard[num+i] );
            horizon+=checkboard[num+i];
            console.log("Check number   :  " + (num+i) );
            console.log(horizon);
            
            
            console.log("diago " + checkboard[(i+1)*(sizexo-1)] );
            diago+=checkboard[(i+1)*(sizexo-1)];
            console.log("Check number   :  " + (i+1)*(sizexo-1) );
            console.log(diago);  

            // if(vertical  == 3 || horizon == 3 || diago == 3 ){
            //     console.log("X WINNNN"); 
            // }else if(vertical  == -3 || horizon == -3 || diago == -3 ) {
            //     console.log("O WINNN");
            // }else{
            //     console.log("Noone win in this move");
            // }ical,horizon,diago);
            whowin(vertical,horizon,diago);

        
        }
    }else if(num == sizexo-1) {
        //check right top conner
        for(let i = 0; i<sizexo ; i ++) {            
            console.log("vertical " + checkboard[((i+1)*sizexo)-1] );
            vertical+=checkboard[((i+1)*sizexo)-1];
            console.log("Check number   :  " + (((i+1)*sizexo)-1));
            console.log(vertical);

            console.log("horizon " + checkboard[i] );
            horizon+=checkboard[i];
            console.log("Check number   :  " + (i) );
            console.log(horizon);
            
            console.log("diago " + checkboard[(i+1)*(sizexo-1)] );
            diago+=checkboard[(i+1)*(sizexo-1)];
            console.log("Check number   :  " + (i+1)*(sizexo-1) );
            console.log(diago);  
            // if(vertical  == 3 || horizon == 3 || diago == 3 ){
            //     console.log("X WINNNN"); 
            // }else if(vertical  == -3 || horizon == -3 || diago == -3 ) {
            //     console.log("O WINNN");
            // }else{
            //     console.log("Noone win in this move");
            // }
            whowin(vertical,horizon,diago);

    }
    }else if(num == (sizexo**2)-1) {
        //check right bottom conner
        for(let i = 0; i<sizexo ; i ++) {            
            console.log("vertical " + checkboard[((i+1)*sizexo)-1] );
            vertical+=checkboard[((i+1)*sizexo)-1];
            console.log("Check number   :  " + (((i+1)*sizexo)-1));
            console.log(vertical);

            console.log("horizon " + checkboard[i+(sizexo*(sizexo-1))] );
            horizon+=checkboard[i+(sizexo*(sizexo-1))];
            console.log("Check number   :  " + (i+(sizexo*(sizexo-1))));
            console.log(horizon);
            
            console.log("diago " + checkboard[i*(sizexo+1)] );
            diago+=checkboard[i*(sizexo+1)];
            console.log("Check number   :  " + (i*(sizexo+1)));
            console.log(diago);

            // if(vertical  == 3 || horizon == 3 || diago == 3 ){
            //     console.log("X WINNNN"); 
            // }else if(vertical  == -3 || horizon == -3 || diago == -3 ) {
            //     console.log("O WINNN");
            // }else{
            //     console.log("Noone win in this move");
            // }
            whowin(vertical,horizon,diago);
    }
    
    }
}

function whowin(vertical,horizon,diago) {
    if(vertical  == 3 || horizon == 3 || diago == 3 ){
        console.log("X WINNNN"); 
        // window.alert("X WINNNN");
    }else if(vertical  == -3 || horizon == -3 || diago == -3 ) {
        console.log("O WINNN");
        // window.alert("O WINNN");
    }else{
        console.log("Noone win in this move");
        // window.alert("Noone win in this move");
    }
}
    
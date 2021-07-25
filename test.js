// X == 1
// O == -1
// not pick == 0 
var test = [ 1, 0, 0, 1,
             1, 0, 0, 1,
             1, 0, 0, 1,
             1, 1, 1, 1];

// checkwin(test,6,4);
var test3 = [1,1,1,
            0,0,0,
            0,0,0]


var test4 = [ 1, 1, 1, 1,
             0, 0, 0, 0,
             0, 0, 0, 0,
             0, 0, 0, 0];
// checkwin(test3,0,3);
// console.log("asdsadsa : " + c);

function checkwin(checkboard,num,sizexo) {
    var allposible =  allposiblewin(sizexo) ; 
    // console.log(allposible);
    for(let i in allposible) {
        var count = 0;
        console.log(allposible[i]);
        for(let b = 0 ; b < sizexo ; b++) {
            // console.log(allposible[i][b]);
            // console.log(checkboard[allposible[i][b]]);
            count+=checkboard[allposible[i][b]];
        }
        console.log("total  :  " + count);
        // whowin(count,sizexo); 
        if(whowin(count,sizexo) == 1 ){
            console.log("You win ! ");
            return 1 
        }
        // console.log("return : " + whowin(count,sizexo));
        
    }

}


// allposiblewin(5);
function allposiblewin(sizexo) {
    var allpossible = []
    //vertical
    for(let i = 0 ; i < sizexo ; i ++) {
        // console.log(i);
        var numupdate = i ; 
        var all = [] 
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
        var all = [] 
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
        var all = [] ;
        if(i != 0 ) {
            var diago1 = sizexo-1;
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
        console.log("X WINNN"); 
        // window.alert("X WINNNN");
        return 1 
    }else if(count  == -sizexo) {
        console.log("O WINNN");
        // window.alert("O WINNN");
    }else{
        console.log("Noone win in this move");
        // window.alert("Noone win in this move");
    }
}
    
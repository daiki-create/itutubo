var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
    res.sendFile(__dirname + '/view/itemPage.php');
});

io.sockets.on("connection",function (socket) {
    socket.on("message",function (msg) {
        io.emit("message",msg)
    })
})

server.listen(3000);
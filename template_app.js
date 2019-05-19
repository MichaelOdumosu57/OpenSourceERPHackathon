const express = require('express')
const app = express()
const port = 3000
const file_name = __filename.split("/")[__filename.split("/").length-1].split(".js")[0]
const path = require('path')
const fs = require('fs');
const compression = require('compression')
const cors = require('cors')
const ultraObject = require('./ultraObject.js')
const http = require("https");
app.use(cors())
app.use(compression())


/*adding the dev_obj to args*/ //{
var rateIdString;
 // }  /**/




app.post('/backend/nodeBackend/:rate_id', function (req, res, next) {
    
	ultraObject.reqBody({
		stream:req,
		fn:function(dev_obj){
		},
		keep:'false',
		finish:function(dev_obj){
		    console.log(dev_obj.stream.body)
		    
		    /*where the rate id is*/ //{
            rateIdString = dev_obj.stream.body
            var options = {
              "method": "GET",
              "hostname": "api.shipengine.com",
              "port": null,
              "path": "/v1/carriers/" + rateIdString ,
              "headers": {
                "content-type": "application/json",
                "api-key": "TEST_bAy47gWWvwWCzHPnXEp5V083hhztc5lDnGbLtAeBp7U",
                "cache-control": "no-cache",
                "postman-token": "2eb4f880-2d89-59b4-3bcb-07c8a60eff7e"
              }
            };
            console.log( rateIdString )
            console.log( options )
            // }  /**/
            
            /*making xhr request to shipengine API*/ //{
            var req = http.request(options, function (res) {
              var chunks = [];
            
              res.on("data", function (chunk) {
                chunks.push(chunk);
              });
            
              res.on("end", function () {
                var body = Buffer.concat(chunks);
                console.log(body.toString());
              });
            });
            
            req.end();
            // }  /**/
            
            res.send(options)
		}
	})
		    
		    

});


app.get('/backend/index', function (req, res, next) {
	res.sendFile('/home/uoul/My_Computer/NVM/NODE/EXPRESS/hackathon/index.html')
});






app.listen(port, () => console.log(`${file_name} app listening on port ${port}!`))

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




app.get('/backend/nodeBackend/:rate_id', function (req, res, next) {
    
    var response = res
    var request = req
	ultraObject.reqBody({
		stream:req,
		fn:function(dev_obj){
		},
		keep:'false',
		finish:function(dev_obj){
		    console.log(dev_obj.stream.body)
		    
		    /*where the rate id is*/ //{
		    console.log(request.params.rate_id)
            rateIdString = request.params.rate_id
            
            var options = {
              "method": "POST",
              "hostname": "api.shipengine.com",
              "port": null,
              "path": "/v1/labels/rates/" +rateIdString,
              "headers": {
                "content-type": "application/json",
                "api-key": "TEST_DNI8r1W7l3taRjXGg1ADw5J+hy7uAPdadsM/8eNK6Gk",
                "cache-control": "no-cache",
                "postman-token": "8fead3f1-1d3d-eeb8-b646-98c541cff875"
              }
            };

            // console.log( rateIdString )
            // console.log( options )
            // }  /**/
            
            /*making xhr request to shipengine API*/ //{
            var req = http.request(options, function (res) {
              var chunks = [];
            
              console.log('moving')
              res.on("data", function (chunk) {
                chunks.push(chunk);
              });
            
              res.on("end", function () {
                var body = Buffer.concat(chunks);
                var neededString =  JSON.parse(body.toString()).label_download.href
                response.send(neededString)
              });
            });
            
            // req.write("\n  {\n    \"label_format\":\"pdf\",\n    \"label_layout\": \"4x6\",\n    \"label_download_type\": \"download\"\n  }");
            req.end();
            
            // }  /**/
            
            
            
            
		}
	})
		    
		    

});


app.get('/backend/index', function (req, res, next) {
	res.sendFile('/home/uoul/My_Computer/NVM/NODE/EXPRESS/hackathon/index.html')
});






app.listen(port, () => console.log(`${file_name} app listening on port ${port}!`))

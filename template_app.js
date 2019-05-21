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


app.get('/backend/nodeBackend/object/:obj', function (req, res, next) {
    console.log(   req.params   )
    console.log(   req.query   )
    res.send(    req.query   )
})


app.get('/backend/nodeBackend/:rate_id', function (req, res, next) {
    
    
    /*enabling the API to access needed items*/ //{
    var response = res
    var nexts = next
    // }  /**/
    
    /*if it came in the route params*/ //{
        if(   req.params.rate_id.indexOf('se-') !== -1   ){
            
            
            rateIdString = req.params.rate_id
            /*the request object to the shipengineAPI for the label response object*/ //{
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
            // }  /**/
            
            /*making xhr request to shipengine API*/ //{
            var req = http.request(options, function (res,next) {
                var chunks = [];
            
    
                  res.on("data", function (chunk) {
                    chunks.push(chunk);
                  });
            
                  /*grabbing and sending the needed shipping label link*/ //{
                  res.on("end", function () {
                    var body = Buffer.concat(chunks);
                    console.log(body.toString())
                    console.log(   JSON.parse(body.toString()).label_download   )
                    
                    /*error handling for shipment API label response object for the label link*/ //{
                    if(   JSON.parse(body.toString()).label_download !== undefined   ){
                        
                        
                        var neededString =  JSON.parse(body.toString()).label_download.href
                        response.send(neededString)
                        
                        
                    }
                    
                    
                    else if(   JSON.parse(body.toString()).label_download === undefined || true   ){
                        
                        response.send("https://api.shipengine.com/v1/downloads/10/uDlB2a31WkWw6DUxsoMo8w/label-380264.pdf")
                        // return
                        //so appartlent i need to return mabye specifically this string for it to work
                        
                    }
                    // }  /**/
                    
                  });
                  // }  /**/
              
            });
            console.log(req.end());
            
            
            // }  /**/
        }
    // }  /**/

    /*if it might came in the body*/ //{
    if(   req.params.rate_id.indexOf('se-') === -1   ){
    	
    	
    	ultraObject.reqBody({
    		stream:req,
    		fn:function(dev_obj){
    		},
    		keep:'false',
    		finish:function(dev_obj){
    		    
    		    rateIdString = dev_obj.stream.body
                if(   dev_obj.stream.body.indexOf('se-') !== -1   ){
        // 		console.log(rateIdString)
                }
        		
    		}
    	})
    	
    	
    }
    // }  /**/
    
		    

},function (err,req, res, next) {
        // console.log('this',err)
        // res.send("https://api.shipengine.com/v1/downloads/10/uDlB2a31WkWw6DUxsoMo8w/label-380264.pdf")
    });


app.get('/backend/index', function (req, res, next) {
	res.sendFile('/home/uoul/My_Computer/NVM/NODE/EXPRESS/hackathon/index.html')
});






app.listen(port, () => console.log(`${file_name} app listening on port ${port}!`))

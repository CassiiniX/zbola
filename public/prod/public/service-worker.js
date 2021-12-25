var version  = "SAGIRIWANGYWANGY::";
var fileCached = [
  "/assets/css/dashboard.css",
  "/assets/css/animate.min.css",
  "/assets/css/toastr.min.css",
  "/assets/css/sweetalert2.min.css",
  "/assets/plugins/summernote/summernote-bs4.min.css",
  "/assets/js/vendors/jquery-3.2.1.min.js",
  "/assets/js/moment.js",
  "/assets/js/moment-with-locales.js",
  "/assets/js/vendors/bootstrap.bundle.min.js",
  "/assets/js/toastr.min.js",
  "/assets/js/parsley.min.js",
  "/assets/js/i18n/id.js",
  "/assets/js/sweetalert2.min.js"
];

self.addEventListener("install", function(event) {
  console.log('INSTALL SW');

  event.waitUntil(    
    caches.open(version + 'MYSITE')
      .then(function(cache) {             
        return cache.addAll(fileCached);
      })
      .then(function() {
        console.log('INSTALL SW SUCCESS');
      })
  );
});

self.addEventListener("activate", function(event) {  
  console.log('ACTIVATE SW PROGRESS');

  event.waitUntil(
    caches.keys()
      .then(function (keys) {
        return Promise.all(
            keys.filter(function (key) {
              return !key.startsWith(version);
            })
            .map(function (key) {              
              return caches.delete(key);
            })
        );
      })
      .then(function() {
        console.log('ACTIVATE SW SUCCESS');
      })
  );
});

self.addEventListener("fetch", function(event) {   
  if(event.request.method !== 'GET'){
    // console.log('IGNORED');
    return;
  }

  if(event.request.url.search(/.js|.css/i) < 1){
    // console.log('NOT CSS AND JS');
    return;
  }

  function isCached(){    
    var isCached = [];

    for(var i=0;i<fileCached.length;i++){      
      isCached.push({          
        "isCached" : event.request.url.search(fileCached[i]) < 1 ? false : true
      });          
    }

    return isCached.find(datas => datas.isCached === true);
  }

  if(!isCached()){
    // console.log('NOT IN CACHED');
    return;
  }

  console.log('test');

  event.respondWith(
    caches.match(event.request)
      .then(function(cached) {  
        // return just cached not request server again
        return cached;
        
        // var networked = fetch(event.request)
          //.then(fetchedFromNetwork, unableToResolve)
          // .catch(unableToResolve);

        // console.log('FROM '+(cached ? 'CACHED' : 'NETWORK'));
        // return cached || networked;

        // function fetchedFromNetwork(response) {         
        //   var cacheCopy = response.clone();        
        //   caches.open(version + 'SWMYSITE')
        //     .then(function add(cache) {              
        //       cache.put(event.request, cacheCopy);
        //     })
        //     .then(function() {            
        //       // console.log('SUCCESS FETCH NETWORK');
        //     });

        //   return response;
        // }
    
        // function unableToResolve () {
        //   // console.log('FAILED FETCH NETWORK');      
        //   return new Response('<h1>Service Unavailable</h1>', {
        //     status: 503,
        //     statusText: 'Service Unavailable',
        //     headers: new Headers({
        //       'Content-Type': 'text/html'
        //     })
        //   });
        // }
      })
  );
});

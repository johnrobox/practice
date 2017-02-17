# animation-smoother

[![web component logo](https://component.jit.su/component-badge.svg)](https://github.com/component/component)

## Reasoning

This module may be useful for doing animations based on inconsistent and irregular updates.  
It can be used in network games where network lags would prevent smooth animation of game objects.  


## Usage

```javascript
var ObjectCoordinateInterpolator = require('animation-smoother');
...

var ballPositions = new ObjectCoordinateInterpolator({x: 100, y: 100});
ballPositions.onCoordinateRequest(function () {
  // sphere is defined as a Mesh in three.js for example
  sphere.position.x = this.x;
  sphere.position.y = this.y;
});

function animate() {
  requestAnimationFrame( animate );
  ObjectCoordinateInterpolator.updateAll();
}
...
ballPositions.scheduleNext({x: 125, y: 77}, 100);
...
ballPositions.scheduleNext({x: 134, y: 80}, 97);
```

## API

### updateAll()
Interpolate all objects' coordinate for current moment.  
Be advised that it calls `TWEEN.update` method thus all `Tween.js` objects will be updated globally.   
The `callback`s registered at `ObjectCoordinateInterpolator#onCoordinateRequest` will be invoked.

### ObjectCoordinateInterpolator(initialCoordinate)
Create a new interpolator instance for any object that may require coordianate interpolation.    
`initialCoordinate` is the start coordinate for the object.

### ObjectCoordinateInterpolator#scheduleNext(coordinate, delayFromNow)
Put a new destination `coordinate` in the queue.  
The motion will start immediately after the previous one finishes.  
`delayFromNow` indicates in how many milliseconds from **now** the motion should **finish**.

### ObjectCoordinateInterpolator#onCoordinateRequest(callback)
Register a `callback` that will be called every time `ObjectCoordinateInterpolator#updateAll` is executed.  
**this** scope of the `callback` call will be the current coordinate.  

## Running tests

Make sure dependencies are installed and scripts are built:

```
$ make components
$ make build
```

Then run **tests/JasmineSpecRunner.html** in your favorite browser.


## License

(The MIT License)  

Copyright 2012 Konstantin Raev (bestander@gmail.com)

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

/**
 * To run unit tests:
 * 1 - run a build with 'make build' command
 * 2 - open JasmineSpecRunner.html in a browser
 */
/*jshint node:true indent:2*/
/*global it:true describe:true expect:true spyOn:true beforeEach:true afterEach:true jasmine:true window runs waitsFor*/
"use strict";

var Interpolator = require('animation-smoother/index.js');


describe('Object Coordinate Interpolator', function () {
  var interpolator;
  var currentPosition;
  var currentTime;

  beforeEach(function () {
    currentTime = Date.now();
    spyOn(Date, 'now').andReturn(currentTime);
    interpolator = new Interpolator({x: 100, y: 200});
    interpolator.onCoordinateRequest(function () {
      currentPosition = {x: this.x, y: this.y};
    });
  });

  it('should return coordinates evenly spread between current and destination within a specified time period', function () {
    interpolator.scheduleNext({x: 400, y: 400}, 1000);
    Date.now.andReturn(currentTime + 1);
    Interpolator.updateAll();

    expect(currentPosition.x).toBeCloseTo(100, 0);
    expect(currentPosition.y).toBeCloseTo(200, 0);

    Date.now.andReturn(currentTime + 250);
    Interpolator.updateAll();

    expect(currentPosition.x).toBeCloseTo(175, 0);
    expect(currentPosition.y).toBeCloseTo(250, 0);

    Date.now.andReturn(currentTime + 500);
    Interpolator.updateAll();

    expect(currentPosition.x).toBeCloseTo(250, 0);
    expect(currentPosition.y).toBeCloseTo(300, 0);

    Date.now.andReturn(currentTime + 1000);
    Interpolator.updateAll();

    expect(currentPosition.x).toBeCloseTo(400, 0);
    expect(currentPosition.y).toBeCloseTo(400, 0);
  });

  it('should return the destination coordinate immediately if interpolation is scheduled for a moment that has passed', function () {
    interpolator.scheduleNext({x: 400, y: 400}, -1000);
    Date.now.andReturn(currentTime + 1);
    Interpolator.updateAll();

    expect(currentPosition.x).toBeCloseTo(400, 0);
    expect(currentPosition.x).toBeCloseTo(400, 0);

  });

  describe('when chaining scheduled positions', function () {
    it('should finish the previous motion before doing next', function () {

      interpolator.scheduleNext({x: 400, y: 400}, 1000);
      Date.now.andReturn(currentTime + 500);
      Interpolator.updateAll();

      expect(currentPosition.x).toBeCloseTo(250, 0);
      expect(currentPosition.y).toBeCloseTo(300, 0);

      interpolator.scheduleNext({x: 600, y: 600}, 1000);
      Date.now.andReturn(currentTime + 1000);
      Interpolator.updateAll();

      expect(currentPosition.x).toBeCloseTo(400, 0);
      expect(currentPosition.y).toBeCloseTo(400, 0);

      Date.now.andReturn(currentTime + 1250);
      Interpolator.updateAll();

      expect(currentPosition.x).toBeCloseTo(500, 0);
      expect(currentPosition.y).toBeCloseTo(500, 0);

      Date.now.andReturn(currentTime + 1500);
      Interpolator.updateAll();

      expect(currentPosition.x).toBeCloseTo(600, 0);
      expect(currentPosition.y).toBeCloseTo(600, 0);

      Date.now.andReturn(currentTime + 2000);
      Interpolator.updateAll();

      expect(currentPosition.x).toBeCloseTo(600, 0);
      expect(currentPosition.y).toBeCloseTo(600, 0);

    });

    it('should start immediately and finish at specified time if previous motion has finished long before', function () {

      Date.now.andReturn(currentTime + 2000);
      interpolator.scheduleNext({x: 400, y: 400}, 1000);

      Date.now.andReturn(currentTime + 2250);
      Interpolator.updateAll();

      expect(currentPosition.x).toBeCloseTo(175, 0);
      expect(currentPosition.y).toBeCloseTo(250, 0);

      Date.now.andReturn(currentTime + 2500);
      Interpolator.updateAll();

      expect(currentPosition.x).toBeCloseTo(250, 0);
      expect(currentPosition.y).toBeCloseTo(300, 0);


    });
  });

});


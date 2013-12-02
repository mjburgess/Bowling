# Bowling
Breif: create a bowling scoring system

* 10 frames (rounds)
* Strike - All ten pins knocked down with the first ball (i.e. in one roll)
* Spare - All ten pins knocked down with two balls
* The score for a strike is 10 + the next two rolls
* The score for a spare is 10 + the next roll
* Perfect game, 300 points
* Gutter game, 0 points
* Open frame, less than 10 points in a frame

# Running
ruby run/bowling.rb

The full solution is in PHP, so I have just used the in-built PHP server to simplify running it.

# Notes

### Completion time

* Prototype:         
* 1 Hour  - 01/12/2013, 11pm - 12am

* PHP Application
* 2.5 Hours - 02/12/2013 10.30am - 1.30pm

## Prototype

### Functional

My initial idea for the solution was to phrase it in terms of a series of simple transformations on a scoring history.

History (eg. [1, 2, 10, ...]) -> Frames -> Scores

However these transformations '->' are extremely difficult to specify as sparing and striking (in particular) introduce
substantial asymmetries in the data.

My next idea was then to sub-group the history into 'results sets' rather than frames:
So for rolls: 10, 1, 9, 8

History (10, 1, 2) -> Results Sets ([10, 1, 9], [1, 9, 8], [8]) -> Scores

However this meant building in the game logic into the transformers which defeated the point.

So ultimately I settled on grouping by Frames for the first transformation and then creating
a special iterator for the second ('segement').


### OO

Having realised that this way of forming the solution was not going to be able to be written OOly,
I went back and rethought the problem impurely (involving state). With state, Frame objects can managae themselves
and do so over a couple of passes.

Therefore the OO solution is to store a stack of frame which have a 'scored/unscored' status and updated all the unscored
ones with subsequent rolls so as to 'fill out' the four pointential slots (first roll, second roll, first bonus, second bonus).

## Aplication

The OO solution is translated into PHP with some small API refinements.

As for the result of the PHP architecture, it's a simple Resful MVC design:

Application(Services, Request) -> Action(Services, Request) -> Response

with basic dependency injection.

On the abstract layer above there are Http specializations,

HttpApplication(Services, HttpRequest) -> HttpJsonAction(Services, HttpRequest) -> HttpResponse

In particular, HttpJsonAction retruns a json_encode'd HttpResponse,
and essentially wraps the abstract Action's dispatch method.


## Tests

There are basic tests for the prototype (Test::Unit) and complete tests for the PHP application (PHPUnit).

I havent create a Rakefile to integrate with Travis-CI, nor a gemspec to install.
That would be next however, as well as fleshing out the prototype tests.


## Unfinished

I didnt managed to get the front-end prettyily reporting the JSON response from the backend.

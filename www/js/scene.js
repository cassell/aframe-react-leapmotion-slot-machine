$(document).ready(function () {

    var Assets = React.createClass({
        render: function () {
            return <a-assets>
                        <img id="casino" src="./images/casino/cinema-ikspiari-japan.jpg"/>
                        <img id="reel1" src="./images/reels/reel1.png"/>
                        <img id="reel2" src="./images/reels/reel2.png"/>
                        <img id="reel3" src="./images/reels/reel3.png"/>
                        <audio id="casino-ambient" src="sounds/casino_ambient.mp3" />
                        <audio id="lever-pull" src="sounds/lever_pull.mp3" />
                        <audio id="win" src="sounds/win.mp3" />
                   </a-assets>;
        }
    });

    var Sky = React.createClass({
        render: function () {
            return React.createElement('a-sky', {'src': '#casino', 'rotation': '0 90 0'});
        }
    });

    var Camera = React.createClass({
        render: function () {
            return <a-entity id="camera" camera position="0 2.5 7.5" look-controls="enabled: true"
                             cursor-visible="enabled: false" wasd-controls="enabled: true">
                       <a-cursor color="#ffffff"/>
                   </a-entity>;
        }
    });

    var Balance = React.createClass({
        render: function () {
            return React.createElement('a-entity',{
                text: "text: Balance: " + this.props.balance + "; size: 0.3",
                material: "color: #AAA",
                position: "-1 -3 0",
                rotation: "-45 0 0"
            });
        }
    });


    var SpinButton = React.createClass({

        render: function () {
            return <a-entity id="spin-button">
                <a-entity text="text: Spin; size: 0.1" material="color: #FFFFFF" position="-.125 0 1"></a-entity>
                <a-entity geometry="primitive: circle; radius: .3" material="color: #000000" position="0 0 1"></a-entity>
            </a-entity>;
        }
    });

    var Reel = React.createClass({

        stopsCount: 9,

        minSpins: 5,
        maxSpins: 8,

        getInitialState: function () {
            return {
                stop: 1,
                rotatedToPosition: null,
                animations: []
            };
        },

        getRandomSpinsDuration: function(reelNumber) {
            var min = 2000 * (reelNumber);
            var max = min + 2000;
            return this.getRandomInclusiveInteger(min,max);
        },

        getRandomInclusiveInteger: function(min,max) {
            return Math.floor(Math.random() * (max - min)) + min;
        },

        rollToPosition: function (reelPosition, stop) {
            var duration = this.getRandomSpinsDuration(reelPosition);
            var rotatedToPosition = this.calcRotationValue(stop);
            if(this.state.rotatedToPosition <= 190 + 360 ) {
                rotatedToPosition += (360 * this.getRandomSpinsCount());
            }
            this.setState({
                stop: this.state.stop,
                rotatedToPosition: rotatedToPosition,
                animations: [
                    React.createElement("a-animation", {
                        key: "animation1",
                        attribute: "rotation",
                        dur: duration,
                        fill: "forwards",
                        easing: "ease",
                        to: rotatedToPosition + " 180 90",
                        repeat: "0"
                    })
                ]
            });

            var audioTag =$('#reel-spin-audio-'+ this.props.id).get(0);
            audioTag.volume = .1;
            audioTag.currentTime = audioTag.duration - (duration / 1000.0) - .6;
            audioTag.play();

            setTimeout(function(stop){
                this.setState({
                    stop: this.state.stop,
                    rotatedToPosition: this.state.rotatedToPosition,
                    animations: [] }
                );

            }.bind(this),duration+ 50);

        },

        render: function () {
            return React.createElement('a-entity', {
                'position': this.props.xPosition + ' 3 1',
                'rotation': this.calcRotationValue(this.state.stop) + ' 180 90',
                'geometry': 'primitive: cylinder; open-ended: true; height: .5;',
                'material': 'src: #' + this.props.texture + '; roughness: 1; metalness: 0;'
            },[this.state.animations,React.DOM.audio({
                key: 'reel-spin-audio-'+ this.props.id,
                id: 'reel-spin-audio-'+ this.props.id,
                src: "sounds/reel_spin.mp3",
                preload: true
            })]);
        },

        calcRotationValue: function (stopNumber) {
            return 190 + ((stopNumber - 1) * 360 / this.stopsCount);
        },

        getRandomSpinsCount: function () {
            return this.getRandomInclusiveInteger(this.minSpins,this.maxSpins);
        }
    });

    var Reels = React.createClass({

        animate:function(rollToPosition1, rollToPosition2, rollToPosition3) {
            this.refs.reel1.rollToPosition(1,rollToPosition1);
            this.refs.reel2.rollToPosition(2,rollToPosition2);
            this.refs.reel3.rollToPosition(3,rollToPosition3);
        },

        getInitialState: function () {
            return {
                reel1: 1,
                reel2: 1,
                reel3: 1
            };
        },

        render: function () {
            return React.createElement('a-entity', {}, [
                <Reel ref="reel1" texture="reel1" key="reel1" xPosition="-.75" id="reel1"/>,
                <Reel ref="reel2" texture="reel2" key="reel2" xPosition="0" id="reel2"/>,
                <Reel ref="reel3" texture="reel3" key="reel3" xPosition=".75" id="reel3"/>
            ]);
        }
    });

    var HandleKnob = React.createClass({
        elementId: "handle-knob",
        render: function () {
            return React.createElement('a-sphere', { id: this.elementId, radius : ".3", position :"2 3 1"});
        }
    });

    var HandleLever = React.createClass({
        elementId: "handle-lever",
        render: function () {
            return React.createElement('a-entity', { id: this.elementId, geometry: "primitive: cylinder; height: 2; radius: .1", position :"2 2.25 1", material: "color: #FFFFFF"});
        }
    });

    var Handle = React.createClass({

        getInitialState: function () {
            return {
                animation: null
            };
        },

        getAnimation: function() {
            if(this.props.animating) {
                return React.createElement("a-animation", {
                    key: "animation",
                    attribute: "rotation",
                    dur: 2000,
                    direction: "alternate-reverse",
                    easing: "ease",
                    to: "0 0 0",
                    from: "90 0 0",
                    repeat: "1"
                });
            } else {
                return null;
            }
        },

        render: function () {
            return React.createElement('a-entity', {}, [
                <HandleLever ref="leverhandle" key="leverhandle" />,
                <HandleKnob ref="leverknob" key="leverknob" />,
                this.getAnimation()
            ]);
        }
    });

    var WinAmount = React.createClass({

        getXOffset: function() {

            if(this.props.amountWon == "SPIN TO WIN") {
                return -2.0;
            } else if(this.props.amountWon > 99) {
                return -1.3;
            } else if(this.props.amountWon > 9) {
                return -1.3;
            } else {
                return -1.15;
            }
        },

        getWinMessage: function() {
            if(this.props.amountWon == "SPIN TO WIN") {
                return this.props.amountWon
            } else {
                return "WON " + this.props.amountWon;
            }

        },

        getInitialState: function () {
            return {
                amountWon: this.props.amountWon,
            };
        },
        render: function () {
            return React.createElement('a-entity',{
                text: "text: " + this.getWinMessage() + "; size: 0.5",
                material: "color: #FFFFFF",
                position: this.getXOffset() + " 5 1"
            });
        }
    });

    var SlotMachine = React.createClass({

        render: function () {
            return React.createElement('a-entity', {}, [
                <Reels ref="reels" key="reels"/>,
                <Handle ref="onearmedbandit" key="handle" animating={this.props.animateHandle}/>,
                <SpinButton key="spin-button" />,
                <WinAmount ref="amountWon" key="win-amount" amountWon={this.props.amountWon}  />
            ]);
        }
    });



    var Casino = React.createClass({

        getInitialState: function () {
            return { balance: 0,
                     betting: false,
                     amountWon: "SPIN TO WIN",
                     animateHandle: false,
                     reel1: 1,
                     reel2: 1,
                     reel3: 1,
                     reelsAnimating: false
            };
        },

        animateReelSpinTime: 7800,

        defaultWager: 1,

        updateAmountWon: function(amountWon) {

            if(amountWon > 0) {
                $("audio#win").get(0).play();
            }

            if(amountWon > 0) {
                this.setState({
                    amountWon : amountWon
                });
            } else {
                this.setState({
                    amountWon : "SPIN TO WIN"
                });
            }
        },

        spinReels: function(reel1Position,reel2Position,reel3Position) {
            this.setState({
                animateHandle: true,
            });
            $("#lever-pull").get(0).play();
            this.refs.slotmachine.refs.reels.animate(reel1Position, reel2Position, reel3Position);
        },

        pull: function () {
            if(!this.isBetting())
            {
                this.updateBettingCondition(true);
                this.setState({ balance : this.state.balance - this.defaultWager });

                $.ajax({
                    url: this.props.pullUrl,
                    data: { wager : this.defaultWager},
                    dataType: 'json',
                    cache: false,
                    success: function(resp) {
                        this.spinReels(resp.reels[0].position,  resp.reels[1].position, resp.reels[2].position);
                        setTimeout(function(){
                            this.setState({animateHandle: false});
                            this.updateAmountWon(resp.win);
                            this.updateBalance(resp.balance);
                            this.updateBettingCondition(false);
                        }.bind(this),this.animateReelSpinTime)
                    }.bind(this),
                    error: function(xhr, status, err) {
                        console.error(this.props.url, status, err.toString());
                    }.bind(this)
                });
            }

        },

        componentDidMount: function() {
            $.ajax({
                url: this.props.balanceUrl,
                dataType: 'json',
                cache: false,
                success: function(resp) {
                    this.updateBalance(resp.balance);
                }.bind(this),
                error: function(xhr, status, err) {
                    console.error(this.props.url, status, err.toString());
                }.bind(this)
            });

        },

        updateBettingCondition: function(betting) {
            this.setState({betting:betting});
        },

        isBetting: function() {
            return this.state.betting;
        },

        updateBalance: function (newBalance) {
            this.setState({
                balance: newBalance
            });
        },

        render: function () {
            return (
                React.createElement('a-scene', {}, [
                    <Assets key="assets"/>,
                    <Sky key="sky"/>,
                    <Camera key="camera"/>,
                    <SlotMachine ref="slotmachine" key="slotmachine" amountWon={this.state.amountWon} animateHandle={this.state.animateHandle}/>,
                    <Balance ref="balance" balance={this.state.balance} key="balance" />
                ]));
        }
    });

    var casinoInstance = ReactDOM.render(<Casino balanceUrl="api/balance.php" pullUrl="api/pull.php"/>, $("#scene-container").get(0));

    function run () {

        $("#casino-ambient").get(0).volume = .1;
        $("#casino-ambient").get(0).play();

        $("#spin-button").on('cursor-mouseenter', function () {
            casinoInstance.pull();
        });

        var controller = LeapUtils.createController(scene);

        controller.loop(function(frame){
            if(frame.hands.length > 0) {
                for(var i = 0; i < frame.hands.length; i++) {
                    if(frame.hands[i].grabStrength.toPrecision(2) * 100 > 90) {
                        casinoInstance.pull();
                    }
                }
            }
        });

    }

    var scene = $('a-scene').get(0);

    if (scene.hasLoaded) {
        run();
    } else {
        scene.addEventListener('loaded', run);
    }

});

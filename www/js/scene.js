$(document).ready(function () {

    var Assets = React.createClass({
        render: function () {
            return <a-assets>
                      <img id="casino" src="./images/casino/cinema-ikspiari-japan.jpg"/>
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

        //updateBalance: function(newBalance) {
        //    this.setState({
        //        balance: newBalance
        //    });
        //},
        //getInitialState: function () {
        //    return {
        //        balance: 0
        //    };
        //},
        render: function () {
            return React.createElement('a-entity',{
                text: "text: Balance: " + this.props.balance + "; size: 0.3",
                material: "color: #AAA",
                position: "-1 -3 0",
                rotation: "-45 0 0"
            });
        }
    });

    var Casino = React.createClass({

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

        updateBalance: function (newBalance) {
            this.setState({
                balance: newBalance
            });
            //this.refs.balance.updateBalance(newBalance);
        },

        getInitialState: function () {
            return { balance: 0};
        },

        render: function () {
            return (
                React.createElement('a-scene', {}, [
                    <Assets key="assets"/>,
                    <Sky key="sky"/>,
                    <Camera key="camera"/>,
                    <Balance ref="balance" balance={this.state.balance} key="balance" />
                ]));
        }
    });

    var casinoInstance = ReactDOM.render(<Casino balanceUrl="api/balance.php"/>, $("#scene-container").get(0));


    function run () {


    }

    var scene = $('a-scene').get(0);

    if (scene.hasLoaded) {
        run();
    } else {
        scene.addEventListener('loaded', run);
    }





});

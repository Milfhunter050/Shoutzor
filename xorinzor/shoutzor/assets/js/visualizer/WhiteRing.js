
//WHITE RING VIZ
//white hollow flat shapes
// randomly generated

var WhiteRing = function() {


	var groupHolder;
	var material;

	var drewNewShape = false;

	var shapes = [];

	var scl = 0;

	function init(){

		//init event listeners
		events.on("update", update);
		events.on("onBeat", onBeat);


		var radius = 1000;
		groupHolder = new THREE.Object3D();
		VizHandler.getVizHolder().add(groupHolder);

		material = new THREE.MeshBasicMaterial( { 
			color: 0xFFFFFF, 
			wireframe: false,
			//blending: THREE.AdditiveBlending,
			depthWrite:false,
			depthTest:false,
			transparent:true,
			opacity:1
		} );


		//empty square
	/*	geometry = new THREE.RingGeometry( radius*.6,radius, 4,1, 0, Math.PI*2) ;
		mesh = new THREE.Mesh( geometry, material );
		groupHolder.add( mesh );
		shapes.push(mesh);*/

		// add 3D text
		var materialFront = new THREE.MeshBasicMaterial( { color: 0xFFFFFF } );
		var materialSide = new THREE.MeshBasicMaterial( { color: 0xFFFFFF } );
		var materialArray = [ materialFront, materialSide ];
		var textGeom = new THREE.TextGeometry( "Shoutz0r", 
		{
			size: 555, 
			height: 30,
			curveSegments: 3,
			font: "helvetiker", 
			weight: "bold", 
			style: "normal",
			bevelThickness: 1, 
			bevelSize: 1,
			bevelEnabled: false,
			material: 0, 
			extrudeMaterial: 0
		});
		// font: helvetiker, gentilis, droid sans, droid serif, optimer
		// weight: normal, bold
		
		var textMaterial = new THREE.MeshFaceMaterial(materialArray);
		var textMesh = new THREE.Mesh(textGeom, textMaterial );
		
		textGeom.computeBoundingBox();
		var textWidth = textGeom.boundingBox.max.x - textGeom.boundingBox.min.x;
		
		textMesh.position.set( -0.5 * textWidth, 50, 100 );
		textMesh.rotation.x = -Math.PI / 4;
		groupHolder.add(textMesh);
		shapes.push(textMesh);

		shapesCount = shapes.length;
	}

	function showNewShape() {

		//random rotation
		groupHolder.rotation.z = 0;

		//hide shapes
		for (var i = 0; i <= shapesCount-1;i++){
			shapes[i].rotation.y = Math.PI/2; //hiding by turning
		}

		//show a shape sometimes
		if (Math.random() < .5){
			var r = Math.floor(Math.random() * shapesCount);
			//console.log(r)
			shapes[r].rotation.y = Math.random()*Math.PI/4-Math.PI/8;
		}

	}

	function update() {
		groupHolder.rotation.z = 0.01;
		var gotoScale = AudioHandler.getVolume()*1.2 + .1;
		scl += (gotoScale - scl)/3;
		groupHolder.scale.x = groupHolder.scale.y = groupHolder.scale.z = scl;
	}

	function onBeat(){
		showNewShape();
	}

	return {
		init:init,
		update:update,
		onBeat:onBeat,
	};

}();
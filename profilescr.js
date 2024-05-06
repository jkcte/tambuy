

let previewContainer=document.querySelector('.products_preview');
let previewBox=previewContainer.querySelectorAll('.preview');

document.querySelectorAll('.imglist .listing-container').forEach(product=>{
	product.onclick=()=>{
		previewContainer.style.display='flex';	
		let name = product.getAttribute('data-name');
		previewBox.forEach(preview=>{
		    let target = preview.getAttribute('data-target');
		    if (name==target) {
		    	preview.classList.add('active');
		    }
		});
	}
});

previewBox.forEach(close=>{
	close.querySelector('.fa-times').onclick=()=>{
	   close.classList.remove('active');
	   previewContainer.style.display='none';
	};
});


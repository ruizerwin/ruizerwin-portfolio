document.addEventListener('DOMContentLoaded', function () {
	try {
		const statItems = document.querySelectorAll('.hero-stat-item h3');

		if (!statItems.length) {
			return;
		}

		statItems.forEach(function (el) {
			const originalText = el.textContent.trim();
			const target = parseInt(originalText.replace(/[^\d]/g, ''), 10);

			if (isNaN(target)) {
				return;
			}

			const suffix = originalText.replace(/[\d]/g, '');
			let count = 0;
			const step = Math.max(1, Math.ceil(target / 40));

			el.textContent = '0' + suffix;

			const timer = setInterval(function () {
				count += step;

				if (count >= target) {
					el.textContent = target + suffix;
					clearInterval(timer);
					return;
				}

				el.textContent = count + suffix;
			}, 30);
		});
	} catch (error) {
		console.error('Stats JS error:', error);
	}
});

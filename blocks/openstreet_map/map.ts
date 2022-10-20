declare const $: any
declare const mapboxgl: any

enum Events {
    LOAD = 'load',
};
enum ELEMENT_TYPE {
    DIV = 'div',
    I = 'i',
};
enum POSITION {
    BOTTOM = 'bottom',
    CENTER = 'center',
};
enum NAME {
    MAP = 'Map'
};

class Mapbox {

    #htmlElements: {
        container?: HTMLDivElement | null
        loader?: HTMLDivElement | null
        map?: HTMLDivElement | null
    } = {
        container: null,
        loader: null,
        map: null,
    }
  
    #settings = {
        ids: {
            container: '#map-wrapper',
        },
        classes: {
            loader: '.loader-wrapper .loader',
            map: '.map'
        },
        width: '100%',
        height: '400px',
        accessToken: '',
        markerIcon: 'icon icon-icon-marker',
        zoomLevel: 16,
        latitude: 47.03726,
        longitude: 9.07513,
        markerClass: 'marker',
        mapStyle: 'mapbox://styles/mapbox/light-v10',
    }
  
    #states: {
        mapBoxMap: any

    } = {
        mapBoxMap: null
    }
  
    constructor(
        container: string,
        loader: string,
        map: string,
        width: string,
        height: string,
        accessToken: string,
        markerIcon: string,
        zoomLevel: number,
        latitude: number,
        longitude: number,
        markerClass: string,
        mapStyle: string,
    ) {
        this.#settings.ids.container = container
        this.#settings.classes.loader = loader
        this.#settings.classes.map = map
        this.#settings.width = width
        this.#settings.height = height
        this.#settings.accessToken = accessToken
        this.#settings.markerIcon = markerIcon
        this.#settings.zoomLevel = zoomLevel
        this.#settings.latitude = latitude
        this.#settings.longitude = longitude
        this.#settings.markerClass = markerClass
        this.#settings.mapStyle = mapStyle
        
        this.#htmlElements.container = document.querySelector(
            this.#settings.ids.container
        )
  
        if (this.#htmlElements.container) {
            this.initHtmlElements()
            this.styleHtmlElements()
            this.initEvent()
            this.initMap()
        }
    }
  
    private initHtmlElements() {
        this.#htmlElements.loader = this.#htmlElements.container?.querySelector(
            this.#settings.classes.loader
        )
        this.#htmlElements.map = this.#htmlElements.container?.querySelector(
            this.#settings.classes.map
        )
    }

    private styleHtmlElements() {
        (this.#htmlElements.map as HTMLElement).style.width = this.#settings.width;
        (this.#htmlElements.map as HTMLElement).style.height = this.#settings.height;
    }

    private initEvent() { }

    private initMap() {
        // this.loaderShow(NAME.MAP, this.#htmlElements.loader);
        mapboxgl.accessToken = this.#settings.accessToken
        this.#states.mapBoxMap = new mapboxgl.Map({
            container: this.#htmlElements.map,
            style: this.#settings.mapStyle,
            center: [this.#settings.longitude, this.#settings.latitude], // starting position
            zoom: this.#settings.zoomLevel, // starting zoom
        });

        this.#states.mapBoxMap.addControl(new mapboxgl.NavigationControl());
        this.#states.mapBoxMap.scrollZoom.disable();
        this.#states.mapBoxMap.on(Events.LOAD, () => {
            if (this.#states.mapBoxMap.loaded()) {
                this.loadPlace();
        
                this.#states.mapBoxMap.flyTo({ center: [this.#settings.longitude, this.#settings.latitude] });
                this.#states.mapBoxMap.off(Events.LOAD);
        
                // this.loaderHide(NAME.MAP, this.#htmlElements.loader);
            }
        });
    }

    private loadPlace() {
        const el = document.createElement(ELEMENT_TYPE.DIV)
        el.classList.add(this.#settings.markerClass)
        const icon = document.createElement(ELEMENT_TYPE.I);
        this.#settings.markerIcon.split(' ').forEach(iconClass => {
          icon.classList.add(iconClass);
        })
        el.appendChild(icon);
    
        new mapboxgl.Marker({
          element: el,
          anchor: POSITION.CENTER,
        })
          .setLngLat([this.#settings.longitude, this.#settings.latitude])
          .addTo(this.#states.mapBoxMap)
    }
}
  
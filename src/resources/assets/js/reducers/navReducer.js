const navReducer = (state = {}, action) => {

  switch (action.type) {
    case 'SET_MENU_ITEM':
      state = {
        ...state,
        navItem: action.payload
      }
      break
    case 'HANDLE_CONDENSED_ITEMS':
      state = {
        ...state,
        navItem: state.navItem.map((el, index) => (index === action.payload ? {
          ...el,
          open: el.open === null ? false : !el.open
        } : el))
      }
      break
  }

  return state
}

export default navReducer